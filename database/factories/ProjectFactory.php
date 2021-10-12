<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'user_id'       => User::inRandomOrder()->first()->id,
        'name'          => $faker->text(10),
        'color'         => '#fcba03',
        'target'        => rand(600, 1000),
        'tercapai'      => rand(1, 1000),
        'description'   => $faker->paragraph(),
        'start_date'    => Carbon::now()->addDays(rand(1, 5))->format('Y-m-d'),
        'end_date'      => Carbon::now()->addMonths(rand(10, 17))->format('Y-m-d'),
        'created_at'    => Carbon::now()->format('Y-m-d'),
        'updated_at'    => Carbon::now()->format('Y-m-d'),
    ];
});
