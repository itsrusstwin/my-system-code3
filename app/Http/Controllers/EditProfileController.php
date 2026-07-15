<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditProfileController extends Controller
{
    public function edit()
    {
        $applicant = Auth::user()->applicant;
        return view('applicants.edit', compact('applicant'));
    }

    public function update(Request $request)
{
    $applicant = Auth::user()->applicant;

    $validated = $request->validate([
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'contact_number' => 'nullable|string|max:20',
        'province' => 'nullable|string|max:100',
        'city_municipality' => 'nullable|string|max:100',
        'barangay' => 'nullable|string|max:100',
        'course' => 'nullable|string|max:150',
        'year_level' => 'nullable|in:1st Year,2nd Year,3rd Year,4th Year',
        'school_name' => 'nullable|string|max:150',
    ]);

    $applicant->update($validated);

    // Keep the User's name in sync with the Applicant's name
    $applicant->user->update([
        'name' => $validated['first_name'] . ' ' . $validated['last_name'],
    ]);

    return redirect()->route('dashboard')->with('success', 'Profile updated!');
}
}