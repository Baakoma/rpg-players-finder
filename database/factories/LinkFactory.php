<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\{Link, System};
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'system_id' => factory(System::class),
        'name' => $faker->words(2, true),
        'url' => $faker->url
    ];
});
