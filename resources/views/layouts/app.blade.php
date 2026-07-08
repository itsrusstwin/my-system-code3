<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Interview System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-700 text-white px-6 py-4 flex gap-6">
        <a href="{{ route('positions.index') }}" class="font-semibold hover:underline">Positions</a>
        <a href="{{ route('applicants.index') }}" class="font-semibold hover:underline">Applicants</a>
        <a href="{{ route('interviews.index') }}" class="font-semibold hover:underline">Interviews</a>
        <a href="{{ route('questions.index') }}" class="font-semibold hover:underline">Questions</a>
    </nav>

    <div class="max-w-4xl mx-auto py-10 px-4">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>