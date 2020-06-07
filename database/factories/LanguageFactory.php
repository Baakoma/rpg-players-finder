<?php

/** @var Factory $factory */

use App\Models\Language;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Language::class, function (Faker $faker) {
    return [
        'name' => $faker->countryISOAlpha3
    ];
});
