@extends('layouts.app')
@section('title', 'Applicants Overview')

@section('content')

@php
    $allApplicants = $applicants->flatten();
    $total = $allApplicants->count();
    $submittedCount = $allApplicants->whereIn('status', ['submitted', 'pending_mswdo', 'exam_scheduled'])->count();
    $passedCount = $allApplicants->whereIn('status', ['exam_passed', 'oriented', 'compliance_met'])->count();
    $paidCount = $allApplicants->where('status', 'paid_out')->count();
    $disqualifiedCount = $allApplicants->filter(fn($a) => str_starts_with($a->status, 'disqualified'))->count();

    $statusLabels = [
        'submitted' => ['label' => 'Application submitted', 'bg' => 'bg-amber-100 dark:bg-amber-900/40', 'text' => 'text-amber-700 dark:text-amber-300'],
        'pending_mswdo' => ['label' => 'Pending MSWDO assessment', 'bg' => 'bg-amber-100 dark:bg-amber-900/40', 'text' => 'text-amber-700 dark:text-amber-300'],
        'exam_scheduled' => ['label' => 'Exam scheduled', 'bg' => 'bg-blue-100 dark:bg-blue-900/40', 'text' => 'text-blue-700 dark:text-blue-300'],
        'exam_passed' => ['label' => 'Exam passed', 'bg' => 'bg-green-100 dark:bg-green-900/40', 'text' => 'text-green-700 dark:text-green-300'],
        'oriented' => ['label' => 'Orientation complete', 'bg' => 'bg-green-100 dark:bg-green-900/40', 'text' => 'text-green-700 dark:text-green-300'],
        'compliance_met' => ['label' => 'Compliance met', 'bg' => 'bg-green-100 dark:bg-green-900/40', 'text' => 'text-green-700 dark:text-green-300'],
        'paid_out' => ['label' => 'Scholarship released', 'bg' => 'bg-emerald-100 dark:bg-emerald-900/40', 'text' => 'text-emerald-700 dark:text-emerald-300'],
    ];
@endphp

<!-- Stat cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Applicants</p>
        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $total }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">In Progress</p>
        <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $submittedCount }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Qualified / Passed</p>
        <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $passedCount }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Disqualified</p>
        <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $disqualifiedCount }}</p>
    </div>
</div>

<!-- Search -->
<div class="mb-5">
    <div class="relative max-w-sm">
        <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        <input type="text" id="applicant-search" placeholder="Search by name..."
               class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
</div>

@forelse ($applicants as $status => $group)
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-3">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                {{ $statusLabels[$status]['label'] ?? ucfirst(str_replace('_', ' ', $status)) }}
            </h2>
            <span class="text-xs text-gray-400 dark:text-gray-500">({{ $group->count() }})</span>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-900/50 text-left text-xs text-gray-500 dark:text-gray-400 uppercase">
                    <tr>
                        <th class="px-5 py-3 font-medium">Name</th>
                        <th class="px-5 py-3 font-medium">School</th>
                        <th class="px-5 py-3 font-medium">Program</th>
                        <th class="px-5 py-3 font-medium">Contact</th>
                        <th class="px-5 py-3 font-medium text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($group as $applicant)
                        <tr class="applicant-row hover:bg-gray-50 dark:hover:bg-gray-900/30">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 dark:bg-blue-900/40 flex items-center justify-center text-xs font-medium text-blue-700 dark:text-blue-300 shrink-0">
                                        {{ strtoupper(substr($applicant->first_name, 0, 1) . substr($applicant->last_name, 0, 1)) }}
                                    </div>
                                    <span class="applicant-name font-medium text-gray-900 dark:text-gray-100">
                                        {{ $applicant->first_name }} {{ $applicant->last_name }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-gray-600 dark:text-gray-300">
                                {{ $applicant->school_name ?? '—' }}
                                @if ($applicant->course)
                                    <div class="text-xs text-gray-400 dark:text-gray-500">{{ $applicant->course }} {{ $applicant->year_level }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <span class="text-xs font-medium px-2 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                    {{ ucfirst($applicant->program_type) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-600 dark:text-gray-300">
                                {{ $applicant->contact_number ?? '—' }}
                            </td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('applicants.show', $applicant) }}"
                                   class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 font-medium hover:underline">
                                    View <i class="ti ti-arrow-right text-sm"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@empty
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-10 text-center text-gray-500 dark:text-gray-400">
        No applicants yet.
    </div>
@endforelse

<script>
document.getElementById('applicant-search').addEventListener('input', function (e) {
    const term = e.target.value.toLowerCase();
    document.querySelectorAll('.applicant-row').forEach(row => {
        const name = row.querySelector('.applicant-name').textContent.toLowerCase();
        row.style.display = name.includes(term) ? '' : 'none';
    });
});
</script>
@endsection