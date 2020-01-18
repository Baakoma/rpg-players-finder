<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'owner_id' => $faker->numberBetween(1, 5),
        'max_users' => $faker->numberBetween(4, 8),
        'public_access' => $faker->boolean,
        'type_id' => $faker->numberBetween(1, 2),
        'system_id' => $faker->numberBetween(1, 2),
    ];
});
