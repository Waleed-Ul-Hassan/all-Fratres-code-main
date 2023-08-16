<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Seeker;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Seeker::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10)
    ];
});
