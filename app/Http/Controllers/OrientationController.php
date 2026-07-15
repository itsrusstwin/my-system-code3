<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Services\ApplicationWorkflowService;
use Illuminate\Http\Request;

class OrientationController extends Controller
{
    protected ApplicationWorkflowService $workflow;

    public function __construct(ApplicationWorkflowService $workflow)
    {
        $this->workflow = $workflow;
    }

    public function complete(Request $request, Applicant $applicant)
    {
        $applicant->orientation()->updateOrCreate([], [
            'attended' => true,
            'signed_acknowledgement' => true,
            'attended_at' => now(),
        ]);

        $this->workflow->completeOrientation($applicant);

        return redirect()
            ->route('applicants.show', $applicant)
            ->with('success', 'Orientation marked complete.');
    }
}