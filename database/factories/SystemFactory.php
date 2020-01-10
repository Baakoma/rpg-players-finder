<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\System;
use Faker\Generator as Faker;

$factory->define(System::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'description' => $faker->paragraph
    ];
});