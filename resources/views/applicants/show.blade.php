@extends('layouts.student')
@section('title', 'My Profile - Iskolar ng Bayan')

@section('content')

@php
    $totalReqs = $applicant->requirements->count();
    $submittedReqs = $applicant->requirements->where('is_submitted', true)->count();
    $progressPercent = $totalReqs > 0 ? round(($submittedReqs / $totalReqs) * 100) : 0;

    $statusLabels = [
        'submitted' => ['label' => 'Application submitted', 'bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
        'pending_mswdo' => ['label' => 'Pending MSWDO assessment', 'bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
        'exam_scheduled' => ['label' => 'Exam scheduled', 'bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
        'exam_passed' => ['label' => 'Exam passed', 'bg' => 'bg-green-100', 'text' => 'text-green-700'],
        'oriented' => ['label' => 'Orientation complete', 'bg' => 'bg-green-100', 'text' => 'text-green-700'],
        'compliance_met' => ['label' => 'Compliance met', 'bg' => 'bg-green-100', 'text' => 'text-green-700'],
        'paid_out' => ['label' => 'Scholarship released', 'bg' => 'bg-green-100', 'text' => 'text-green-700'],
    ];
    $currentStatus = $statusLabels[$applicant->status] ?? ['label' => ucfirst(str_replace('_', ' ', $applicant->status)), 'bg' => 'bg-gray-100', 'text' => 'text-gray-700'];

    $initials = strtoupper(substr($applicant->first_name, 0, 1) . substr($applicant->last_name, 0, 1));
@endphp

<!-- Profile card -->
<div id="status" class="bg-white border border-gray-200 rounded-xl p-5 mb-5">
    <div class="flex justify-between items-start">
        <div class="flex gap-4">
            <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-xl font-medium text-blue-700">
                {{ $initials }}
            </div>
            <div>
    <p class="font-medium text-lg mb-0.5">{{ $applicant->first_name }} {{ $applicant->last_name }}</p>
    <p class="text-sm text-gray-500 mb-1">
        Student ID: {{ $applicant->school_id ?? 'N/A' }}
        @if ($applicant->course_year)
            &nbsp;•&nbsp; {{ $applicant->course_year }}
        @endif
    </p>
    @if ($applicant->school_name)
        <p class="text-sm text-gray-500">{{ $applicant->school_name }}</p>
    @endif
</div>
        </div>
        <span class="{{ $currentStatus['bg'] }} {{ $currentStatus['text'] }} text-xs font-medium px-3 py-1.5 rounded-full">
            {{ $currentStatus['label'] }}
        </span>
    </div>

    <div class="border-t border-gray-100 mt-4 pt-3.5 grid grid-cols-1 md:grid-cols-3 gap-3.5 text-sm">
    <div>
        <span class="text-gray-500">Email</span><br>
        <span class="text-gray-800">{{ $applicant->user->email ?? 'N/A' }}</span>
    </div>
    <div>
        <span class="text-gray-500">Contact number</span><br>
        <span class="text-gray-800">{{ $applicant->contact_number ?? 'N/A' }}</span>
    </div>
    <div>
    <span class="text-gray-500">Address</span><br>
    <span class="text-gray-800">
        @php
            $addressParts = array_filter([
                $applicant->province,
                $applicant->city_municipality,
                $applicant->barangay,
            ]);
        @endphp
        {{ $addressParts ? implode(', ', $addressParts) : 'N/A' }}
    </span>
</div>
</div>

<div class="mt-4 pt-3.5 border-t border-gray-100">
    <a href="{{ route('profile.edit') }}" class="text-blue-600 text-sm font-medium hover:underline">
        Edit Profile →
    </a>
</div>
</div>

<!-- Requirements checklist -->
<div id="requirements" class="bg-white border border-gray-200 rounded-xl p-5">
    <div class="flex justify-between items-center mb-1">
        <p class="font-medium text-sm">Requirements checklist</p>
        <span class="text-xs text-gray-500">{{ $submittedReqs }} of {{ $totalReqs }} submitted</span>
    </div>
    <div class="h-1.5 bg-gray-100 rounded-full my-2.5 mb-4 overflow-hidden">
        <div class="h-full bg-blue-600" style="width: {{ $progressPercent }}%"></div>
    </div>

    @foreach ($applicant->requirements as $req)
        <div class="flex items-center justify-between py-3 border-t border-gray-100">
            <div class="flex items-center gap-2.5">
                <i class="ti ti-file-text text-lg text-gray-500"></i>
                <div>
                    <p class="text-sm mb-0">{{ $req->requirement->name }}</p>
                    <p class="text-xs text-gray-500 mb-0">PDF or image, max 5MB</p>
                </div>
            </div>
            @if ($req->is_submitted)
                <span class="bg-green-100 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full">Uploaded</span>
            @else
                <button class="bg-blue-600 text-white text-xs font-medium px-3.5 py-1.5 rounded-lg flex items-center gap-1.5">
                    <i class="ti ti-upload text-sm"></i> Upload
                </button>
            @endif
        </div>
    @endforeach

    <div class="mt-4 pt-3.5 border-t border-gray-100 flex justify-end">
        <button class="bg-blue-600 text-white text-sm font-medium px-5 py-2.5 rounded-lg">
            Submit application
        </button>
    </div>
</div>

@endsection