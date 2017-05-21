<?php

use Illuminate\Database\Seeder;

class WorkingVariantsSeeder extends Seeder
{
    private $variants = [
        'Full time job in office',
        'Remote job (full time)',
        'Freelance (one-time projects)',
        'Relocation to another city',
        'Relocation to another country'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->variants as $variant) {
            \App\Models\WorkingVariant::create(['name' => $variant]);
        }
    }
}
