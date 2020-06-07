<?php

/** @var Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'role' => 0,
        'password' => bcrypt($faker->password(6, 10)),
    ];
});
