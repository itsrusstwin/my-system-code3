@extends('layouts.app')
@section('title', 'Questions')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Interview Questions</h1>
        <a href="{{ route('questions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Question
        </a>
    </div>

    <div class="bg-white rounded shadow divide-y">
        @forelse ($questions as $question)
            <div class="flex justify-between items-center p-4">
                <span>{{ $question->question }}</span>
                <div class="flex gap-3">
                    <a href="{{ route('questions.edit', $question) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('questions.destroy', $question) }}"
                        onsubmit="return confirm('Delete this question?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="p-4 text-gray-500">No questions yet.</p>
        @endforelse
    </div>
@endsection