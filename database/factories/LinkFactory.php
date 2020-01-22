<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'url' => $faker->url
    ];
});
