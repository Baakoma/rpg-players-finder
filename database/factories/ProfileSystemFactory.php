<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\{ProfileSystem, Profile, System};
use Faker\Generator as Faker;

$factory->define(ProfileSystem::class, function (Faker $faker) {
    return [
        'profile_id' => factory(Profile::class),
        'system_id' => factory(System::class),
        'lore_knowledge_rating' => $faker->numberBetween($min = 0, $max = 10),
        'mechanic_knowledge_rating' => $faker->numberBetween($min = 0, $max = 10),
        'roleplay_rating' => $faker->numberBetween($min = 0, $max = 10),
        'experience' => $faker->numberBetween($min = 0, $max = 10),
    ];
});
