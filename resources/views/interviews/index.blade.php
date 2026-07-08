@extends('layouts.app')
@section('title', 'Interviews')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Interviews</h1>
        <a href="{{ route('interviews.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Schedule Interview
        </a>
    </div>

    <div class="bg-white rounded shadow divide-y">
        @forelse ($interviews as $interview)
            <a href="{{ route('interviews.show', $interview) }}" class="flex justify-between items-center p-4 hover:bg-gray-50">
                <span>{{ $interview->interview_date }} — {{ $interview->position->name ?? 'No position' }}</span>
                <span class="text-sm bg-blue-100 text-blue-700 px-2 py-1 rounded-full">{{ ucfirst($interview->status) }}</span>
            </a>
        @empty
            <p class="p-4 text-gray-500">No interviews scheduled yet.</p>
        @endforelse
    </div>
@endsection