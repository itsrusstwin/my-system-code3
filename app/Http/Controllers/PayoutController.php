<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Services\ApplicationWorkflowService;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    protected ApplicationWorkflowService $workflow;

    public function __construct(ApplicationWorkflowService $workflow)
    {
        $this->workflow = $workflow;
    }

    public function release(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'reference_no' => 'nullable|string|max:100',
        ]);

        $applicant->payouts()->create([
            'amount' => $validated['amount'],
            'reference_no' => $validated['reference_no'] ?? null,
            'released_at' => now(),
        ]);

        $this->workflow->releasePayout($applicant, (float) $validated['amount']);

        return redirect()
            ->route('applicants.show', $applicant)
            ->with('success', 'Payout released.');
    }
}