<?php

namespace App;

// app/Enums/ApplicationStatus.php
enum ApplicationStatus: string
{
    case SUBMITTED           = 'submitted';           // Step 1-3
    case INCOMPLETE          = 'incomplete';           // Step 2 - kumpletuhin
    case PENDING_VERIFICATION= 'pending_verification'; // Step 4
    case DISQUALIFIED_POLICY = 'disqualified_policy';  // Step 4 fail
    case PENDING_MSWDO       = 'pending_mswdo';        // Step 5-6
    case DISQUALIFIED_POVERTY= 'disqualified_poverty'; // Step 6 fail
    case EXAM_SCHEDULED      = 'exam_scheduled';       // Step 7
    case EXAM_PASSED         = 'exam_passed';          // Step 8 pass
    case EXAM_FAILED         = 'exam_failed';          // Step 8 fail
    case ORIENTED            = 'oriented';             // Step 9
    case COMPLIANCE_PENDING  = 'compliance_pending';   // Step 10
    case COMPLIANCE_MET      = 'compliance_met';
    case PAID_OUT            = 'paid_out';             // Step 11
    case APPEALED            = 'appealed';
}
