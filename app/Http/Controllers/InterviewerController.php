<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Interviewer;
use Illuminate\Http\Request;

class InterviewerController extends Controller
{
    public function store(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $interview->interviewers()->create([
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->route('interviews.show', $interview)->with('success', 'Interviewer added.');
    }

    public function destroy(Interviewer $interviewer)
    {
        $interviewId = $interviewer->interview_id;
        $interviewer->delete();

        return redirect()->route('interviews.show', $interviewId)->with('success', 'Interviewer removed.');
    }
}