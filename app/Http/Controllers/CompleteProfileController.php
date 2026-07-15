<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompleteProfileController extends Controller
{
    public function create()
    {
        // If they already have an applicant profile, send them to their status page instead
        $user = Auth::user();
        if ($user->applicant) {
            return redirect()->route('applicants.show', $user->applicant);
        }

        $requirements = Requirement::all();
        return view('applicants.create', compact('requirements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'nullable|string|max:50',
            'grade_average' => 'required|numeric|min:75|max:100',
            'program_type' => 'required|in:current,aspiring',
        ]);

        $user = Auth::user();

        $applicant = Applicant::create([
            'user_id' => $user->id,
            'first_name' => explode(' ', $user->name)[0] ?? $user->name,
            'last_name' => explode(' ', $user->name)[1] ?? '',
            'school_id' => $validated['school_id'] ?? null,
            'grade_average' => $validated['grade_average'],
            'program_type' => $validated['program_type'],
        ]);

        foreach (Requirement::all() as $requirement) {
            $applicant->requirements()->create([
                'requirement_id' => $requirement->id,
                'is_submitted' => false,
                'file_path' => null,
                'submitted_at' => null,
            ]);
        }
        return redirect()->route('applicants.show', $applicant)->with('success', 'Profile completed!');
    }
}