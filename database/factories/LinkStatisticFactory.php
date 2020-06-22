<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LinkStatistic;
use Faker\Generator as Faker;

$ipPool = [];

$faker = \Faker\Factory::create();

for ($i = 0; $i < 50; $i++) {
    $ipPool[] = $faker->ipv4;
}

$factory->define(LinkStatistic::class, function (Faker $faker) use ($ipPool) {

    return [
        'visitor_ip' => $faker->randomElement($ipPool),
        'visit_at' => $faker->dateTimeBetween('-30 days', 'now'),
    ];
});
