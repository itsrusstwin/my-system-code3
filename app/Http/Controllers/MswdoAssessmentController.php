<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Services\ApplicationWorkflowService;
use Illuminate\Http\Request;

class MswdoAssessmentController extends Controller
{
    protected ApplicationWorkflowService $workflow;

    public function __construct(ApplicationWorkflowService $workflow)
    {
        $this->workflow = $workflow;
    }

    public function assess(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'referral_slip_no' => 'nullable|string|max:50',
            'is_qualified' => 'required|boolean',
        ]);

        $applicant->mswdoAssessment()->updateOrCreate([], [
            'referral_slip_no' => $validated['referral_slip_no'] ?? null,
            'is_qualified' => $validated['is_qualified'],
            'assessed_at' => now(),
        ]);

        $this->workflow->assessPoverty($applicant, (bool) $validated['is_qualified']);

        return redirect()
            ->route('applicants.show', $applicant)
            ->with('success', 'MSWDO assessment recorded.');
    }
}