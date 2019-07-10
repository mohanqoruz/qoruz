<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Users\Models\User as User;
use App\Accounts\Models\Account as Account;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
        'account_id' => function () {
            return factory(Account::class)->create()->id;
        },
        'phone' => 1223456789
    ];
});
