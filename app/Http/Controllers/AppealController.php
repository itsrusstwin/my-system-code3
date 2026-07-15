<?php

namespace App\Http\Controllers;

use App\Models\Disqualification;
use App\Models\Appeal;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'disqualification_id' => 'required|exists:disqualifications,id',
            'reconsideration_notes' => 'required|string',
        ]);

        Appeal::create([
            'disqualification_id' => $validated['disqualification_id'],
            'reconsideration_notes' => $validated['reconsideration_notes'],
            'result' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Appeal filed successfully. Awaiting review.');
    }
}