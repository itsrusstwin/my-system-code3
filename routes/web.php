<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\InterviewerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\InterviewerScoreController;

// Default welcome page
Route::get('/', function () {
    return view('welcome');
});

// -----------------------------
// Positions
// -----------------------------
Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
Route::get('/positions/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
Route::put('/positions/{position}', [PositionController::class, 'update'])->name('positions.update');
Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');

// -----------------------------
// Applicants
// -----------------------------
Route::get('/applicants', [ApplicantController::class, 'index'])->name('applicants.index');
Route::get('/applicants/create', [ApplicantController::class, 'create'])->name('applicants.create');
Route::post('/applicants', [ApplicantController::class, 'store'])->name('applicants.store');
Route::get('/applicants/{applicant}', [ApplicantController::class, 'show'])->name('applicants.show');
Route::get('/applicants/{applicant}/edit', [ApplicantController::class, 'edit'])->name('applicants.edit');
Route::put('/applicants/{applicant}', [ApplicantController::class, 'update'])->name('applicants.update');
Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('applicants.destroy');

// -----------------------------
// Interviews
// -----------------------------
Route::get('/interviews', [InterviewController::class, 'index'])->name('interviews.index');
Route::get('/interviews/create', [InterviewController::class, 'create'])->name('interviews.create');
Route::post('/interviews', [InterviewController::class, 'store'])->name('interviews.store');
Route::get('/interviews/{interview}', [InterviewController::class, 'show'])->name('interviews.show');
Route::put('/interviews/{interview}', [InterviewController::class, 'update'])->name('interviews.update');
Route::delete('/interviews/{interview}', [InterviewController::class, 'destroy'])->name('interviews.destroy');

// -----------------------------
// Interviewers (panel members on an interview)
// -----------------------------
Route::post('/interviews/{interview}/interviewers', [InterviewerController::class, 'store'])->name('interviewers.store');
Route::delete('/interviewers/{interviewer}', [InterviewerController::class, 'destroy'])->name('interviewers.destroy');

// -----------------------------
// Questions
// -----------------------------
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

// Attach an existing question to a specific interview
Route::post('/interviews/{interview}/questions', [QuestionController::class, 'attachToInterview'])->name('interviews.questions.attach');

// -----------------------------
// Interviewer Scores
// -----------------------------
Route::post('/interviews/{interview}/scores', [InterviewerScoreController::class, 'store'])->name('scores.store');
Route::put('/scores/{interviewerScore}', [InterviewerScoreController::class, 'update'])->name('scores.update');