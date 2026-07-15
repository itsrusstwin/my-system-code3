<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Services\ApplicationWorkflowService;
use Illuminate\Http\Request;

class WasteComplianceController extends Controller
{
    protected ApplicationWorkflowService $workflow;

    public function __construct(ApplicationWorkflowService $workflow)
    {
        $this->workflow = $workflow;
    }

    public function store(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'semester' => 'required|string|max:20',
            'kilos_submitted' => 'required|numeric|min:0',
        ]);

        $isCompliant = $validated['kilos_submitted'] >= 10;

        $applicant->wasteCompliance()->create([
            'semester' => $validated['semester'],
            'kilos_submitted' => $validated['kilos_submitted'],
            'is_compliant' => $isCompliant,
        ]);

        $this->workflow->recordWasteCompliance($applicant, (float) $validated['kilos_submitted']);

        return redirect()
            ->route('applicants.show', $applicant)
            ->with('success', 'Waste compliance recorded.');
    }
}