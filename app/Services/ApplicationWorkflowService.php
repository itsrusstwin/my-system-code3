<?php

namespace App\Services;

use App\Models\Applicant;

class ApplicationWorkflowService
{
    public function submitRequirements(Applicant $a, array $submittedIds) { /* Step 2-3 */ }

    public function verifyPolicy(Applicant $a): void
    {
        // Step 4
        $v = $a->verification;
        if ($v->in_4ps || $v->in_spes || !$v->one_scholar_per_family_ok) {
            $this->disqualify($a, 'policy_verification', 'Fails eligibility policy');
            return;
        }
        $a->update(['status' => 'pending_mswdo']);
    }

    public function assessPoverty(Applicant $a, bool $qualified): void
    {
        // Step 5-6
        $qualified
            ? $a->update(['status' => 'exam_scheduled'])
            : $this->disqualify($a, 'mswdo', 'Did not meet poverty threshold');
    }

    public function postExamResult(Applicant $a, bool $passed): void
    {
        // Step 7-8
        $passed
            ? $a->update(['status' => 'exam_passed'])
            : $this->disqualify($a, 'exam', 'Failed qualifying exam');
    }

    public function completeOrientation(Applicant $a) { /* Step 9 */ }
    public function recordWasteCompliance(Applicant $a, float $kilos) { /* Step 10 */ }
    public function releasePayout(Applicant $a, float $amount) { /* Step 11 */ }

    protected function disqualify(Applicant $a, string $stage, string $reason)
    {
        $a->disqualifications()->create(['stage' => $stage, 'reason' => $reason, 'notice_issued_at' => now()]);
        $a->update(['status' => "disqualified_{$stage}"]);
        // notify applicant + allow appeal
    }
}