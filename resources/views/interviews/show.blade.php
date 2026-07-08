@extends('layouts.app')
@section('title', 'Interview Details')

@section('content')
    <div class="bg-white p-6 rounded shadow mb-6">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">
            Interview — {{ $interview->interview_date }}
        </h1>
        <p class="mb-2"><span class="font-medium">Position:</span> {{ $interview->position->name ?? '—' }}</p>
        <p class="mb-6"><span class="font-medium">Status:</span> {{ ucfirst($interview->status) }}</p>

        <h2 class="text-lg font-semibold mb-2">Applicants</h2>
        <ul class="mb-6 list-disc list-inside">
            @foreach ($interview->applicants as $applicant)
                <li>{{ $applicant->first_name }} {{ $applicant->last_name }}</li>
            @endforeach
        </ul>

        <h2 class="text-lg font-semibold mb-2">Interviewers (Panel)</h2>
        <ul class="mb-6 list-disc list-inside">
            @foreach ($interview->interviewers as $panelist)
                <li>{{ $panelist->user->name ?? '—' }}</li>
            @endforeach
        </ul>

        <h2 class="text-lg font-semibold mb-2">Questions</h2>
        <ul class="list-disc list-inside">
            @foreach ($interview->interviewerQuestions as $iq)
                <li>{{ $iq->question->question ?? '—' }}</li>
            @endforeach
        </ul>
    </div>
@endsection