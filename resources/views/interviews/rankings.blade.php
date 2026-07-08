@extends('layouts.app')
@section('title', 'Interview Rankings')

@section('content')
    <h1 class="text-2xl font-bold text-blue-700 mb-6">
        Rankings — {{ $interview->interview_date }}
    </h1>

    <div class="bg-white rounded shadow divide-y">
        @foreach ($rankings as $rank)
            <div class="flex justify-between items-center p-4">
                <span>{{ $rank['applicant']->first_name }} {{ $rank['applicant']->last_name }}</span>
                <span class="font-semibold">
                    Total: {{ $rank['total_score'] }} | Avg: {{ number_format($rank['average_score'], 2) }}
                </span>
            </div>
        @endforeach
    </div>
@endsection