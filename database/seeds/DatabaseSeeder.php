<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccessSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VacanciesTableSeeder::class);
    }
}
