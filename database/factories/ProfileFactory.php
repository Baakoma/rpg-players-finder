<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

//$faker = Faker\Factory::create('pl_PL'); POG

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'yesterday'),
        'sex' => $faker->numberBetween($min = 0, $max = 1),
        'description' => $faker->paragraph
    ];
});
