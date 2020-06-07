<?php

/** @var Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'birth_date' => $faker->date('Y-m-d', 'yesterday'),
        'sex' => $faker->numberBetween(0, 1),
        'description' => $faker->paragraph
    ];
});
