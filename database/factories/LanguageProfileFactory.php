<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\{LanguageProfile, Language, Profile};
use Faker\Generator as Faker;

$factory->define(LanguageProfile::class, function (Faker $faker) {
    return [
      'language_id' => factory(Language::class),
      'profile_id' => factory(Profile::class)
    ];
});
