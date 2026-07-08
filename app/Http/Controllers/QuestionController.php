<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Interview;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->get();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
        ]);

        Question::create($validated);

        return redirect()->route('questions.index')->with('success', 'Question added.');
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question' => 'required|string',
        ]);

        $question->update($validated);

        return redirect()->route('questions.index')->with('success', 'Question updated.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question removed.');
    }

    // Attach an existing question to a specific interview
    public function attachToInterview(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
        ]);

        $interview->interviewerQuestions()->create([
            'question_id' => $validated['question_id'],
        ]);

        return redirect()->route('interviews.show', $interview)->with('success', 'Question added to interview.');
    }
}