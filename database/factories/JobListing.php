<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JobListing;
use App\Model;
use Faker\Generator as Faker;

$factory->define(JobListing::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->text(10),
        'description' => $faker->text(100),
        'company' => $faker->text(10),
        'posted_at' => $faker->dateTime,
        'reference_id' => $faker->uuid
    ];
});
