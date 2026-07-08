@extends('layouts.app')
@section('title', 'Add Question')

@section('content')
    <h1 class="text-2xl font-bold text-blue-700 mb-6">Add Question</h1>

    <form method="POST" action="{{ route('questions.store') }}" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        <div>
            <label class="block font-medium text-gray-700">Question</label>
            <textarea name="question" rows="3" class="mt-1 w-full border rounded p-2" required>{{ old('question') }}</textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save</button>
    </form>
@endsection