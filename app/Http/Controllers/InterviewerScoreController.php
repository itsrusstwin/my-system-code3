<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\InterviewerQuestion;
use App\Models\InterviewApplicant;
use App\Services\InterviewService;
use Illuminate\Http\Request;

class InterviewerScoreController extends Controller
{
    protected InterviewService $interviewService;

    public function __construct(InterviewService $interviewService)
    {
        $this->interviewService = $interviewService;
    }

    public function store(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'interviewer_question_id' => 'required|exists:interviewer_questions,id',
            'interview_applicant_id' => 'required|exists:interview_applicants,id',
            'score' => 'required|integer|min:0',
        ]);

        $interviewerQuestion = InterviewerQuestion::findOrFail($validated['interviewer_question_id']);
        $interviewApplicant = InterviewApplicant::findOrFail($validated['interview_applicant_id']);

        $this->interviewService->recordScore(
            $interview,
            $interviewerQuestion,
            $interviewApplicant,
            $validated['score']
        );

        return redirect()->route('interviews.show', $interview)->with('success', 'Score recorded.');
    }
}