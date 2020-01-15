<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
   return[

        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'lastName' => $faker->name,
        'password' => bcrypt('password'),
        'api_token' => bcrypt('password'),
        'avatar_id' => rand(0,4),
    ];
});
