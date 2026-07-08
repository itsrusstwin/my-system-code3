<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-2xl font-bold text-blue-700 mb-4">
            {{ $applicant->first_name }} {{ $applicant->last_name }}
        </h1>

        <p class="mb-2"><span class="font-medium">Applicant Type:</span> {{ ucfirst($applicant->program_type) }}</p>
        <p class="mb-2"><span class="font-medium">Grade Average:</span> {{ $applicant->grade_average }}</p>
        <p class="mb-6">
            <span class="font-medium">Current Status:</span>
            <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                {{ str_replace('_', ' ', $applicant->status->value ?? $applicant->status) }}
            </span>
        </p>

        <h2 class="text-lg font-semibold mb-2">Requirements Checklist</h2>
        <ul class="mb-6">
            @foreach ($applicant->requirements as $req)
                <li class="flex items-center gap-2">
                    <span>{{ $req->is_submitted ? '✅' : '⬜' }}</span>
                    {{ $req->requirement->name }}
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>