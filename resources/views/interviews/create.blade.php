@extends('layouts.app')
@section('title', 'Schedule Interview')

@section('content')
    <h1 class="text-2xl font-bold text-blue-700 mb-6">Schedule Interview</h1>

    <form method="POST" action="{{ route('interviews.store') }}" class="bg-white p-6 rounded shadow space-y-4">
        @csrf

        <div>
            <label class="block font-medium text-gray-700">Interview Date & Time</label>
            <input type="datetime-local" name="interview_date" class="mt-1 w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Position</label>
            <select name="position_id" class="mt-1 w-full border rounded p-2">
                <option value="">-- Select --</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-2">Applicants</label>
            @foreach ($applicants as $applicant)
                <div class="flex items-center gap-2 mb-1">
                    <input type="checkbox" name="applicant_ids[]" value="{{ $applicant->id }}" id="app_{{ $applicant->id }}">
                    <label for="app_{{ $applicant->id }}">{{ $applicant->first_name }} {{ $applicant->last_name }}</label>
                </div>
            @endforeach
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-2">Interviewers (Panel)</label>
            @foreach ($users as $user)
                <div class="flex items-center gap-2 mb-1">
                    <input type="checkbox" name="interviewer_ids[]" value="{{ $user->id }}" id="user_{{ $user->id }}">
                    <label for="user_{{ $user->id }}">{{ $user->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Schedule</button>
    </form>
@endsection