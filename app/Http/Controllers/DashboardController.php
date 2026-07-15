<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $applicant = $user->applicant;
        $requirements = Requirement::all();

        return view('dashboard', compact('applicant', 'requirements'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
    'school_id' => 'nullable|string|max:50',
    'program_type' => 'required|in:current,aspiring',
    'contact_number' => 'nullable|string|max:20',
    'province' => 'nullable|string|max:100',
    'city_municipality' => 'nullable|string|max:100',
    'barangay' => 'nullable|string|max:100',
    'course' => 'nullable|string|max:150',
    'year_level' => 'nullable|in:1st Year,2nd Year,3rd Year,4th Year',
    'school_name' => 'nullable|string|max:150',
]);

    $user = Auth::user();

    $applicant = Applicant::create([
    'user_id' => $user->id,
    'first_name' => explode(' ', $user->name)[0] ?? $user->name,
    'last_name' => explode(' ', $user->name)[1] ?? '',
    'school_id' => $validated['school_id'] ?? null,
    'program_type' => $validated['program_type'],
    'contact_number' => $validated['contact_number'] ?? null,
    'province' => $validated['province'] ?? null,
    'city_municipality' => $validated['city_municipality'] ?? null,
    'barangay' => $validated['barangay'] ?? null,
    'course' => $validated['course'] ?? null,
    'year_level' => $validated['year_level'] ?? null,
    'school_name' => $validated['school_name'] ?? null,
]);

    foreach (Requirement::all() as $requirement) {
        $applicant->requirements()->create([
            'requirement_id' => $requirement->id,
            'is_submitted' => false,
            'file_path' => null,
            'submitted_at' => null,
        ]);
    }

    return redirect()->route('dashboard')->with('success', 'Profile completed!');
}
}