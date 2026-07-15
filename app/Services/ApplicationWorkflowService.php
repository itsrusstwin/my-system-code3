<?php

namespace App\Services;

use App\Models\Applicant;

class ApplicationWorkflowService
{
    public function submitRequirements(Applicant $a, array $submittedIds)
    {
        // Step 2-3 logic (optional, handled in controller currently)
    }

    public function verifyPolicy(Applicant $a): void
    {
        $v = $a->verification;
        if ($v->in_4ps || $v->in_spes || !$v->one_scholar_per_family_ok) {
            $this->disqualify($a, 'policy_verification', 'Fails eligibility policy');
            return;
        }
        $a->update(['status' => 'pending_mswdo']);
    }

    public function assessPoverty(Applicant $a, bool $qualified): void
    {
        $qualified
            ? $a->update(['status' => 'exam_scheduled'])
            : $this->disqualify($a, 'mswdo', 'Did not meet poverty threshold');
    }

    public function postExamResult(Applicant $a, bool $passed): void
    {
        $passed
            ? $a->update(['status' => 'exam_passed'])
            : $this->disqualify($a, 'exam', 'Failed qualifying exam');
    }

    public function completeOrientation(Applicant $a)
    {
        $a->update(['status' => 'oriented']);
    }

    public function recordWasteCompliance(Applicant $a, float $kilos)
    {
        $a->update(['status' => $kilos >= 10 ? 'compliance_met' : 'compliance_pending']);
    }

    public function releasePayout(Applicant $a, float $amount)
    {
        $a->update(['status' => 'paid_out']);
    }

    protected function disqualify(Applicant $a, string $stage, string $reason)
    {
        $a->disqualifications()->create([
            'stage' => $stage,
            'reason' => $reason,
            'notice_issued_at' => now(),
        ]);
        $a->update(['status' => "disqualified_{$stage}"]);
    }
}