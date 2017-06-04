<?php

use Illuminate\Database\Seeder;

class UserTrendsSeeder extends Seeder
{
    protected $trends = [
        "Java",
        ".NET",
        "iOS",
        "Android",
        "Lead",
        "Design",
        "PHP",
        "Python",
        "Ruby",
        "C++",
        "Unity",
        "QA",
        "SQL",
        "Sysadmin",
        "Embedded",
        "Project Manager",
        "Product Manager",
        "Business Analyst",
        "HR",
        "Marketing",
        "Other"
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->trends as $trend) {
            App\Models\UserTrend::create(['name' => $trend]);
        }
    }
}
