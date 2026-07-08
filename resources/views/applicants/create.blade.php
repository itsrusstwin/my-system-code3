<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iskolar ng Bayan - Application Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Iskolar ng Bayan Application</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('applicants.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}"
                    class="mt-1 w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}"
                    class="mt-1 w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">School ID</label>
                <input type="text" name="school_id" value="{{ old('school_id') }}"
                    class="mt-1 w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Grade Average (must be 75% or higher)</label>
                <input type="number" step="0.01" name="grade_average" value="{{ old('grade_average') }}"
                    class="mt-1 w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Applicant Type</label>
                <select name="program_type" class="mt-1 w-full border rounded p-2" required>
                    <option value="">-- Select --</option>
                    <option value="current" {{ old('program_type') === 'current' ? 'selected' : '' }}>Current Scholar</option>
                    <option value="aspiring" {{ old('program_type') === 'aspiring' ? 'selected' : '' }}>Aspiring Scholar</option>
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-2">Requirements Submitted</label>
                @foreach ($requirements as $requirement)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="requirement_{{ $requirement->id }}"
                            id="requirement_{{ $requirement->id }}" class="mr-2">
                        <label for="requirement_{{ $requirement->id }}">{{ $requirement->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Submit Application
            </button>
        </form>
    </div>
</body>
</html>