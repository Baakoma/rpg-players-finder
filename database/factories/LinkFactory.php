<?php

/** @var Factory $factory */

use App\Models\Link;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'url' => $faker->url
    ];
});
