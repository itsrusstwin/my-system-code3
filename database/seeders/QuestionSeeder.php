<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            'Tell us about yourself and your relevant experience.',
            'Why are you interested in this position?',
            'Describe a challenging situation you faced at work and how you handled it.',
            'What are your strengths and weaknesses?',
            'Where do you see yourself in five years?',
        ];

        foreach ($questions as $question) {
            Question::create(['question' => $question]);
        }
    }
}