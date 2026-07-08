@extends('layouts.app')
@section('title', 'Edit Position')

@section('content')
    <h1 class="text-2xl font-bold text-blue-700 mb-6">Edit Position</h1>

    <form method="POST" action="{{ route('positions.update', $position) }}" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium text-gray-700">Position Name</label>
            <input type="text" name="name" value="{{ old('name', $position->name) }}" class="mt-1 w-full border rounded p-2" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
    </form>
@endsection