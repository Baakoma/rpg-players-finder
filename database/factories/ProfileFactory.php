<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'birth_date' => $faker->date('Y-m-d', 'yesterday'),
        'sex' => $faker->numberBetween(0, 1),
        'description' => $faker->paragraph
    ];
});
