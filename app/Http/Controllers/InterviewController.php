<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Position;
use App\Models\Applicant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\InterviewService;

class InterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::with('position')->latest()->get();
        return view('interviews.index', compact('interviews'));
    }

    public function create()
    {
        $positions = Position::all();
        $applicants = Applicant::all();
        $users = User::all();
        return view('interviews.create', compact('positions', 'applicants', 'users'));
    }

    public function rankings(Interview $interview, InterviewService $interviewService)
{
    $interview->load('applicants');
    $rankings = $interviewService->rankApplicants($interview);
    return view('interviews.rankings', compact('interview', 'rankings'));
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'interview_date' => 'required|date',
            'position_id' => 'nullable|exists:positions,id',
            'status' => 'nullable|string|max:50',
            'applicant_ids' => 'array',
            'applicant_ids.*' => 'exists:applicants,id',
            'interviewer_ids' => 'array',
            'interviewer_ids.*' => 'exists:users,id',
        ]);

        $interview = Interview::create([
            'interview_date' => $validated['interview_date'],
            'position_id' => $validated['position_id'] ?? null,
            'status' => $validated['status'] ?? 'pending',
        ]);

        // Attach applicants
        if (!empty($validated['applicant_ids'])) {
            $interview->applicants()->attach($validated['applicant_ids']);
        }

        // Assign interviewers (panel members)
        if (!empty($validated['interviewer_ids'])) {
            foreach ($validated['interviewer_ids'] as $userId) {
                $interview->interviewers()->create(['user_id' => $userId]);
            }
        }

        return redirect()->route('interviews.show', $interview)->with('success', 'Interview scheduled.');
    }

    public function show(Interview $interview)
    {
        $interview->load('position', 'applicants', 'interviewers.user', 'questions');
        return view('interviews.show', compact('interview'));
    }

    public function update(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'interview_date' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        $interview->update($validated);

        return redirect()->route('interviews.show', $interview)->with('success', 'Interview updated.');
    }

    public function destroy(Interview $interview)
    {
        $interview->delete();
        return redirect()->route('interviews.index')->with('success', 'Interview removed.');
    }
}