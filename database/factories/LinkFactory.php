<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'short_uri' => \Illuminate\Support\Str::random(12),
        'expires_at' => $faker->boolean(50) ? $faker->dateTimeBetween('-10 days', '10 days') : null,
        'is_commercial' => $faker->boolean(20),
    ];
});
