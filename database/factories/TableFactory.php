<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'identify'      => Str::random(5) . uniqid(),
        'description'   => $faker->sentence,
        'tenant_id'     => factory(Tenant::class)
    ];
});