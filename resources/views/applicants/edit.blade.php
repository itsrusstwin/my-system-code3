@extends('layouts.student')
@section('title', 'Edit Profile - Iskolar ng Bayan')

@section('content')
<div class="bg-white border border-gray-200 rounded-xl p-6 max-w-2xl">
    <h1 class="text-xl font-semibold mb-6">Update Your Profile</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name', $applicant->first_name) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name', $applicant->last_name) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
        <input type="text" name="course" value="{{ old('course', $applicant->course) }}"
            placeholder="e.g. BS Computer Science"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Year Level</label>
        <select name="year_level" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            <option value="">-- Select --</option>
            <option value="1st Year" {{ old('year_level', $applicant->year_level) === '1st Year' ? 'selected' : '' }}>1st Year</option>
            <option value="2nd Year" {{ old('year_level', $applicant->year_level) === '2nd Year' ? 'selected' : '' }}>2nd Year</option>
            <option value="3rd Year" {{ old('year_level', $applicant->year_level) === '3rd Year' ? 'selected' : '' }}>3rd Year</option>
            <option value="4th Year" {{ old('year_level', $applicant->year_level) === '4th Year' ? 'selected' : '' }}>4th Year</option>
        </select>
    </div>
</div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">School / Alumni</label>
            <input type="text" name="school_name" value="{{ old('school_name', $applicant->school_name) }}"
                placeholder="e.g. Santa Cruz National High School Alumni"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number', $applicant->contact_number) }}"
                placeholder="e.g. 0917 123 4567"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
        </div>

       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
        <input type="text" name="province" value="{{ old('province', $applicant->province) }}"
            placeholder="e.g. Laguna"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">City / Municipality</label>
        <input type="text" name="city_municipality" value="{{ old('city_municipality', $applicant->city_municipality) }}"
            placeholder="e.g. Santa Cruz"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Barangay</label>
    <input type="text" name="barangay" value="{{ old('barangay', $applicant->barangay) }}"
        placeholder="e.g. Barangay Poblacion I"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
</div>

        <button type="submit" class="bg-blue-600 text-white text-sm font-medium px-5 py-2.5 rounded-lg">
            Save Changes
        </button>
    </form>
</div>
@endsection