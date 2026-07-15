<?php

namespace App\Http\Controllers;

use App\Models\ApplicantRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RequirementUploadController extends Controller
{
    public function store(Request $request, ApplicantRequirement $requirement)
    {
        // Only the owning student can upload to their own requirement
        abort_unless(
            $requirement->applicant_id === Auth::user()->applicant?->id,
            403
        );

        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
        ]);

        // Remove the old file if this is a re-upload
        if ($requirement->file_path) {
            Storage::disk('public')->delete($requirement->file_path);
        }

        $path = $request->file('file')->store('requirements', 'public');

        $requirement->update([
            'file_path' => $path,
            'is_submitted' => true,
            'submitted_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Requirement uploaded successfully.');
    }
}