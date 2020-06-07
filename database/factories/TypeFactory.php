<?php

/** @var Factory $factory */

use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Type::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'description' => $faker->paragraph,
    ];
});
