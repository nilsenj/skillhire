<?php

use Illuminate\Database\Seeder;

class UserWorkingVariantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\Profile::find(1);
        $user->workingVariants()->sync([1,2,3,4]);
    }
}
