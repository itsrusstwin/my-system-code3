<?php

namespace App\Services;

use App\Models\Interview;
use App\Models\Applicant;
use App\Models\InterviewApplicant;
use App\Models\Interviewer;
use App\Models\InterviewerQuestion;
use App\Models\InterviewerScore;

class InterviewService
{
    /**
     * Attach an applicant to an interview (creates the pivot record).
     */
    public function addApplicant(Interview $interview, Applicant $applicant): InterviewApplicant
    {
        return $interview->interviewApplicants()->firstOrCreate([
            'applicant_id' => $applicant->id,
        ]);
    }

    /**
     * Remove an applicant from an interview.
     */
    public function removeApplicant(Interview $interview, Applicant $applicant): void
    {
        $interview->interviewApplicants()
            ->where('applicant_id', $applicant->id)
            ->delete();
    }

    /**
     * Assign an interviewer (panel member) to an interview.
     */
    public function addInterviewer(Interview $interview, int $userId): Interviewer
    {
        return $interview->interviewers()->firstOrCreate([
            'user_id' => $userId,
        ]);
    }

    /**
     * Attach a question to this interview's question set.
     */
    public function addQuestion(Interview $interview, int $questionId): InterviewerQuestion
    {
        return $interview->interviewerQuestions()->firstOrCreate([
            'question_id' => $questionId,
        ]);
    }

    /**
     * Record or update a score for a specific applicant on a specific question.
     */
    public function recordScore(
        Interview $interview,
        InterviewerQuestion $interviewerQuestion,
        InterviewApplicant $interviewApplicant,
        int $score
    ): InterviewerScore {
        return InterviewerScore::updateOrCreate(
            [
                'interview_id' => $interview->id,
                'interviewer_question_id' => $interviewerQuestion->id,
                'interview_applicant_id' => $interviewApplicant->id,
            ],
            [
                'score' => $score,
            ]
        );
    }

    /**
     * Get the total score for one applicant in one interview
     * (sum of all question scores from all interviewers).
     */
    public function getTotalScore(Interview $interview, Applicant $applicant): int
    {
        $interviewApplicant = $interview->interviewApplicants()
            ->where('applicant_id', $applicant->id)
            ->first();

        if (!$interviewApplicant) {
            return 0;
        }

        return InterviewerScore::where('interview_id', $interview->id)
            ->where('interview_applicant_id', $interviewApplicant->id)
            ->sum('score');
    }

    /**
     * Get the average score for one applicant in one interview.
     */
    public function getAverageScore(Interview $interview, Applicant $applicant): float
    {
        $interviewApplicant = $interview->interviewApplicants()
            ->where('applicant_id', $applicant->id)
            ->first();

        if (!$interviewApplicant) {
            return 0.0;
        }

        return (float) InterviewerScore::where('interview_id', $interview->id)
            ->where('interview_applicant_id', $interviewApplicant->id)
            ->avg('score');
    }

    /**
     * Rank all applicants in an interview by total score, highest first.
     * Returns a collection of ['applicant' => Applicant, 'total_score' => int]
     */
    public function rankApplicants(Interview $interview)
    {
        return $interview->applicants->map(function ($applicant) use ($interview) {
            return [
                'applicant' => $applicant,
                'total_score' => $this->getTotalScore($interview, $applicant),
                'average_score' => $this->getAverageScore($interview, $applicant),
            ];
        })->sortByDesc('total_score')->values();
    }

    /**
     * Mark an interview as completed.
     */
    public function markCompleted(Interview $interview): void
    {
        $interview->update(['status' => 'completed']);
    }

    /**
     * Mark an interview as cancelled.
     */
    public function markCancelled(Interview $interview): void
    {
        $interview->update(['status' => 'cancelled']);
    }
}