<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Position;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = Applicant::with('position')->latest()->get();
        return view('applicants.index', compact('applicants'));
    }

    public function create()
    {
        $positions = Position::all();
        return view('applicants.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'extension_name' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'civil_status' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'position_id' => 'nullable|exists:positions,id',
        ]);

        $applicant = Applicant::create($validated);

        return redirect()->route('applicants.show', $applicant)->with('success', 'Applicant registered.');
    }

    public function show(Applicant $applicant)
    {
        $applicant->load('position', 'interviews');
        return view('applicants.show', compact('applicant'));
    }

    public function edit(Applicant $applicant)
    {
        $positions = Position::all();
        return view('applicants.edit', compact('applicant', 'positions'));
    }

    public function update(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'extension_name' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'civil_status' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'position_id' => 'nullable|exists:positions,id',
        ]);

        $applicant->update($validated);

        return redirect()->route('applicants.show', $applicant)->with('success', 'Applicant updated.');
    }

    public function destroy(Applicant $applicant)
    {
        $applicant->delete();
        return redirect()->route('applicants.index')->with('success', 'Applicant removed.');
    }
}