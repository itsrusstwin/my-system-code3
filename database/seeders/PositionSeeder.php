<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            'Teacher I',
            'Administrative Aide',
            'Human Resource Officer',
            'IT Support Staff',
            'Accounting Clerk',
        ];

        foreach ($positions as $name) {
            Position::create(['name' => $name]);
        }
    }
}