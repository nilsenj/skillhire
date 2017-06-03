<?php

use Illuminate\Database\Seeder;

class EnglishSkillLevelSeeder extends Seeder
{
    private $skills = [
        'No English',
        'Low level (Pre-Intermediate)',
        'Tech. docs reading level (Intermediate)',
        'Speak and write with mistakes (Upper Intermediate)',
        'Fluent English (Advanced/Fluent)'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->skills as $skill) {
            \App\Models\EnglishSkill::create(['name' => $skill]);
        }
    }
}
