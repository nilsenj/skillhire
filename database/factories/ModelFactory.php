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

    return [
        'title' => $faker->words(4, true),
        'author_id' => $faker->numberBetween(1,21),
        'body' => implode(' ', $faker->sentences(10)),
        'company' => $faker->company,
        'company_description' => implode(' ',$faker->sentences()),
        'location' => $faker->countryISOAlpha3 . ', ' .$faker->city
    ];
});
