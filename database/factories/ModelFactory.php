<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = '21317636',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Vacancy::class, function (Faker\Generator $faker) {
    $company = \App\Models\Company::create([
        'name' => $faker->company,
        'description' => implode(' ',$faker->sentences(6)),
        'title' => implode(' ',$faker->sentences(2))
    ]);

    $userTrends = \App\Models\UserTrend::all()->toArray();
    $userVariants = \App\Models\WorkingVariant::all()->toArray();
    return [
        'title' => $faker->words(4, true),
        'author_id' => $faker->numberBetween(1,21),
        'body' => implode(' ', $faker->sentences(10)),
        'company_id' => $company->id,
        'main_trend' => $userTrends[$faker->numberBetween(0, count($userTrends) - 1)]['name'],
        'working_variant' => $userVariants[$faker->numberBetween(0, count($userVariants) - 1)]['name'],
        'location' => $faker->countryISOAlpha3 . ', ' .$faker->city
    ];
});

$factory->define(App\Models\Proposal::class, function (Faker\Generator $faker) {
//    $authors =
    return [
        'author_id' => $faker->numberBetween(1,21),
        'replier_id' => $faker->numberBetween(1,21)
    ];
});
