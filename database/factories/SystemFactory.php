<?php

/** @var Factory $factory */

use App\Models\System;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(System::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'description' => $faker->paragraph
    ];
});
