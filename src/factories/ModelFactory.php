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

$factory->define(NanokaWeb\AsyncGame\User::class, function (Faker\Generator $faker) {
    return [
        'first_name'       => $faker->firstName,
        'last_name'        => $faker->lastName,
        'last_name'        => $faker->name,
        'email'            => $faker->email,
        'facebook_user_id' => $faker->randomNumber(),
        'picture'          => $faker->imageUrl(200, 200),
        'coins'            => $faker->randomNumber(2),
        'role_id'          => $faker->randomElement([1, 2, 3]),
    ];
});
