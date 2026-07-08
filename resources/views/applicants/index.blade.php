@extends('layouts.app')
@section('title', 'Applicants')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Applicants</h1>
        <a href="{{ route('applicants.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Applicant
        </a>
    </div>

    <div class="bg-white rounded shadow divide-y">
        @forelse ($applicants as $applicant)
            <a href="{{ route('applicants.show', $applicant) }}" class="flex justify-between items-center p-4 hover:bg-gray-50">
                <span>{{ $applicant->first_name }} {{ $applicant->last_name }}</span>
                <span class="text-sm text-gray-500">{{ $applicant->position->name ?? 'No position' }}</span>
            </a>
        @empty
            <p class="p-4 text-gray-500">No applicants yet.</p>
        @endforelse
    </div>
@endsection