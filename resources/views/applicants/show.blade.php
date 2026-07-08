@extends('layouts.app')
@section('title', 'Applicant Details')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">
            {{ $applicant->first_name }} {{ $applicant->middle_name }} {{ $applicant->last_name }} {{ $applicant->extension_name }}
        </h1>

        <p class="mb-2"><span class="font-medium">Gender:</span> {{ ucfirst($applicant->gender) ?? '—' }}</p>
        <p class="mb-2"><span class="font-medium">Birthdate:</span> {{ $applicant->birthdate ?? '—' }}</p>
        <p class="mb-2"><span class="font-medium">Civil Status:</span> {{ $applicant->civil_status ?? '—' }}</p>
        <p class="mb-2"><span class="font-medium">Address:</span> {{ $applicant->address ?? '—' }}</p>
        <p class="mb-6"><span class="font-medium">Position:</span> {{ $applicant->position->name ?? '—' }}</p>

        <h2 class="text-lg font-semibold mb-2">Scheduled Interviews</h2>
        <ul class="mb-6">
            @forelse ($applicant->interviews as $interview)
                <li>
                    <a href="{{ route('interviews.show', $interview) }}" class="text-blue-600 hover:underline">
                        {{ $interview->interview_date }} — {{ ucfirst($interview->status) }}
                    </a>
                </li>
            @empty
                <li class="text-gray-500">No interviews scheduled yet.</li>
            @endforelse
        </ul>

        <a href="{{ route('applicants.edit', $applicant) }}" class="text-blue-600 hover:underline">Edit Applicant</a>
    </div>
@endsection