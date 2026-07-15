    @extends('layouts.student')
    @section('title', 'My Dashboard - Iskolar ng Bayan')

    @section('content')

    @if (!$applicant)

        {{-- Profile not yet completed --}}
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 max-w-2xl mx-auto">
            <h1 class="text-xl font-semibold text-blue-700 dark:text-blue-400 mb-2">Complete Your Profile</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Just a few more details to finish your scholarship application.</p>

            @if ($errors->any())
                <div class="bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 p-4 rounded mb-4 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('applicants.store') }}" class="space-y-5">
        @csrf

        <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Academic Info</h2>

        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300">School Name</label>
            <input type="text" name="school_name" value="{{ old('school_name') }}"
                placeholder="e.g. Santa Cruz National High School"
                class="mt-1 w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded p-2">
        </div>

        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300">School ID</label>
            <input type="text" name="school_id" value="{{ old('school_id') }}" class="mt-1 w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded p-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300">Course</label>
            <input type="text" name="course" value="{{ old('course') }}"
                placeholder="e.g. BS Computer Science"
                class="mt-1 w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded p-2">
        </div>

        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300">Year Level</label>
            <select name="year_level" class="mt-1 w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded p-2">
                <option value="">-- Select --</option>
                <option value="1st Year" {{ old('year_level') === '1st Year' ? 'selected' : '' }}>1st Year</option>
                <option value="2nd Year" {{ old('year_level') === '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                <option value="3rd Year" {{ old('year_level') === '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                <option value="4th Year" {{ old('year_level') === '4th Year' ? 'selected' : '' }}>4th Year</option>
            </select>
        </div>
    </div>

        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300">Applicant Type</label>
            <select name="program_type" class="mt-1 w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded p-2" required>
                <option value="">-- Select --</option>
                <option value="current" {{ old('program_type') === 'current' ? 'selected' : '' }}>Current Scholar</option>
                <option value="aspiring" {{ old('program_type') === 'aspiring' ? 'selected' : '' }}>Aspiring Scholar</option>
            </select>
        </div>

        <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide pt-2 border-t dark:border-gray-700">Contact & Address</h2>

        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number') }}"
                placeholder="e.g. 0917 123 4567"
                class="mt-1 w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded p-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-300">Province</label>
                <input type="text" name="province" value="{{ old('province') }}"
                    placeholder="e.g. Laguna"
                    class="mt-1 w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded p-2">
            </div>
            <div>
                <label class="block font-medium text-gray-700 dark:text-gray-300">City / Municipality</label>
                <input type="text" name="city_municipality" value="{{ old('city_municipality') }}"
                    placeholder="e.g. Santa Cruz"
                    class="mt-1 w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded p-2">
            </div>
        </div>

        <div>
            <label class="block font-medium text-gray-700 dark:text-gray-300">Barangay</label>
            <input type="text" name="barangay" value="{{ old('barangay') }}"
                placeholder="e.g. Barangay Poblacion I"
                class="mt-1 w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded p-2">
        </div>

        <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide pt-2 border-t dark:border-gray-700">Requirements</h2>

        <div>
            @foreach ($requirements as $requirement)
                <div class="flex items-center mb-2">
                    <input type="checkbox" name="requirement_{{ $requirement->id }}" id="requirement_{{ $requirement->id }}" class="mr-2">
                    <label for="requirement_{{ $requirement->id }}" class="text-gray-700 dark:text-gray-300">{{ $requirement->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 w-full">
            Submit Application
        </button>
    </form>
        </div>

    @else

        {{-- Full profile view (same as before) --}}
        @php
            $totalReqs = $applicant->requirements->count();
            $submittedReqs = $applicant->requirements->where('is_submitted', true)->count();
            $progressPercent = $totalReqs > 0 ? round(($submittedReqs / $totalReqs) * 100) : 0;

            $statusLabels = [
                'submitted' => ['label' => 'Application submitted', 'bg' => 'bg-amber-100 dark:bg-amber-900/40', 'text' => 'text-amber-700 dark:text-amber-300'],
                'pending_mswdo' => ['label' => 'Pending MSWDO assessment', 'bg' => 'bg-amber-100 dark:bg-amber-900/40', 'text' => 'text-amber-700 dark:text-amber-300'],
                'exam_scheduled' => ['label' => 'Exam scheduled', 'bg' => 'bg-blue-100 dark:bg-blue-900/40', 'text' => 'text-blue-700 dark:text-blue-300'],
                'exam_passed' => ['label' => 'Exam passed', 'bg' => 'bg-green-100 dark:bg-green-900/40', 'text' => 'text-green-700 dark:text-green-300'],
                'oriented' => ['label' => 'Orientation complete', 'bg' => 'bg-green-100 dark:bg-green-900/40', 'text' => 'text-green-700 dark:text-green-300'],
                'compliance_met' => ['label' => 'Compliance met', 'bg' => 'bg-green-100 dark:bg-green-900/40', 'text' => 'text-green-700 dark:text-green-300'],
                'paid_out' => ['label' => 'Scholarship released', 'bg' => 'bg-green-100 dark:bg-green-900/40', 'text' => 'text-green-700 dark:text-green-300'],
            ];
            $currentStatus = $statusLabels[$applicant->status] ?? ['label' => ucfirst(str_replace('_', ' ', $applicant->status)), 'bg' => 'bg-gray-100 dark:bg-gray-700', 'text' => 'text-gray-700 dark:text-gray-300'];

            $initials = strtoupper(substr($applicant->first_name, 0, 1) . substr($applicant->last_name, 0, 1));
        @endphp

        <div id="status" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 mb-5">
            <div class="flex justify-between items-start">
                <div class="flex gap-4">
                    <div class="w-16 h-16 rounded-full bg-blue-50 dark:bg-blue-900/40 flex items-center justify-center text-xl font-medium text-blue-700 dark:text-blue-300">
                        {{ $initials }}
                    </div>
                    <div>
                        <p class="font-medium text-lg mb-0.5 text-gray-900 dark:text-gray-100">{{ $applicant->first_name }} {{ $applicant->last_name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
        Student ID: {{ $applicant->school_id ?? 'N/A' }}
        @if ($applicant->course || $applicant->year_level)
            &nbsp;•&nbsp; {{ $applicant->course }}{{ $applicant->course && $applicant->year_level ? ', ' : '' }}{{ $applicant->year_level }}
        @endif
    </p>
                        @if ($applicant->school_name)
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $applicant->school_name }}</p>
                        @endif
                    </div>
                </div>
                <span class="{{ $currentStatus['bg'] }} {{ $currentStatus['text'] }} text-xs font-medium px-3 py-1.5 rounded-full">
                    {{ $currentStatus['label'] }}
                </span>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-700 mt-4 pt-3.5 grid grid-cols-1 md:grid-cols-3 gap-3.5 text-sm">
                <div>
                    <span class="text-gray-500 dark:text-gray-400">Email</span><br>
                    <span class="text-gray-800 dark:text-gray-200">{{ $applicant->user->email ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-gray-500 dark:text-gray-400">Contact number</span><br>
                    <span class="text-gray-800 dark:text-gray-200">{{ $applicant->contact_number ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-gray-500 dark:text-gray-400">Address</span><br>
                    <span class="text-gray-800 dark:text-gray-200">
                        @php
                            $addressParts = array_filter([
                                $applicant->province,
                                $applicant->city_municipality,
                                $applicant->barangay,
                            ]);
                        @endphp
                        {{ $addressParts ? implode(', ', $addressParts) : 'N/A' }}
                    </span>
                </div>
            </div>

            <div class="mt-4 pt-3.5 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('profile.edit') }}" class="text-blue-600 dark:text-blue-400 text-sm font-medium hover:underline">
                    Edit Profile →
                </a>
            </div>
        </div>

        <div id="requirements" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5">
            <div class="flex justify-between items-center mb-1">
                <p class="font-medium text-sm text-gray-900 dark:text-gray-100">Requirements checklist</p>
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $submittedReqs }} of {{ $totalReqs }} submitted</span>
            </div>
            <div class="h-1.5 bg-gray-100 dark:bg-gray-700 rounded-full my-2.5 mb-4 overflow-hidden">
                <div class="h-full bg-blue-600" style="width: {{ $progressPercent }}%"></div>
            </div>

            @foreach ($applicant->requirements as $req)
            <div class="flex items-center justify-between py-3 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-2.5">
                    <i class="ti ti-file-text text-lg text-gray-500 dark:text-gray-400"></i>
                    <div>
                        <p class="text-sm mb-0 text-gray-900 dark:text-gray-100">{{ $req->requirement->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-0">PDF or image, max 5MB</p>
                    </div>
                </div>

                @if ($req->is_submitted)
                    <div class="flex items-center gap-2.5">
                        @if ($req->file_path)
                            <a href="{{ asset('storage/' . $req->file_path) }}" target="_blank"
                               class="text-xs text-blue-600 dark:text-blue-400 hover:underline">View</a>
                        @endif
                        <span class="bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 text-xs font-medium px-2.5 py-1 rounded-full">Uploaded</span>
                        <form method="POST" action="{{ route('requirements.upload', $req) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png" id="file-{{ $req->id }}" class="hidden" onchange="this.form.submit()">
                            <label for="file-{{ $req->id }}" class="text-xs text-gray-500 dark:text-gray-400 hover:underline cursor-pointer">Replace</label>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('requirements.upload', $req) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png" id="file-{{ $req->id }}" class="hidden" onchange="this.form.submit()">
                        <label for="file-{{ $req->id }}" class="bg-blue-600 text-white text-xs font-medium px-3.5 py-1.5 rounded-lg flex items-center gap-1.5 cursor-pointer">
                            <i class="ti ti-upload text-sm"></i> Upload
                        </label>
                    </form>
                @endif
            </div>
        @endforeach
        </div>

    @endif

    @endsection