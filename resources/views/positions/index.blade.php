@extends('layouts.app')
@section('title', 'Positions')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Positions</h1>
        <a href="{{ route('positions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Position
        </a>
    </div>

    <div class="bg-white rounded shadow divide-y">
        @forelse ($positions as $position)
            <div class="flex justify-between items-center p-4">
                <span>{{ $position->name }}</span>
                <div class="flex gap-3">
                    <a href="{{ route('positions.edit', $position) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('positions.destroy', $position) }}"
                        onsubmit="return confirm('Delete this position?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="p-4 text-gray-500">No positions yet.</p>
        @endforelse
    </div>
@endsection