@extends('layouts.app')
@section('title', 'Add Applicant')

@section('content')
    <h1 class="text-2xl font-bold text-blue-700 mb-6">Register Applicant</h1>

    <form method="POST" action="{{ route('applicants.store') }}" class="bg-white p-6 rounded shadow space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="mt-1 w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Extension Name (Jr., Sr.)</label>
                <input type="text" name="extension_name" value="{{ old('extension_name') }}" class="mt-1 w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Gender</label>
                <select name="gender" class="mt-1 w-full border rounded p-2">
                    <option value="">-- Select --</option>
                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Birthdate</label>
                <input type="date" name="birthdate" value="{{ old('birthdate') }}" class="mt-1 w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Civil Status</label>
                <input type="text" name="civil_status" value="{{ old('civil_status') }}" class="mt-1 w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Position Applied For</label>
                <select name="position_id" class="mt-1 w-full border rounded p-2">
                    <option value="">-- Select --</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Address</label>
            <input type="text" name="address" value="{{ old('address') }}" class="mt-1 w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit</button>
    </form>
@endsection