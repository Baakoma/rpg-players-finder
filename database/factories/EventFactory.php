<?php

/** @var Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'owner_id' => $faker->numberBetween(1, 5),
        'max_users' => $faker->numberBetween(4, 8),
        'public_access' => $faker->boolean,
        'type_id' => $faker->numberBetween(1, 2),
        'system_id' => $faker->numberBetween(1, 2),
        'language_id' => $faker->numberBetween(1, 3),
    ];
});
