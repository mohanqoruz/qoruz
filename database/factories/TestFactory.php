<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Users\Models\User as User;
use App\Accounts\Models\Account as Account;
use App\Subscriptions\Models\Addon as Addon;
use App\Subscriptions\Models\Pricing as Pricing;


use Faker\Generator as Faker;


$factory->define(Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->randomElement(['agency', 'brand','api', 'whitelabel']),
        'status' => $faker->randomElement(['active', 'trialing','suspended', 'deleted']),
        
    ];
});

$factory->define(User::class, function (Faker $faker) {
	$accounts = App\Accounts\Models\Account::pluck('id')->all();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
        'account_id' =>   $faker->randomElement($accounts),
        'phone' => 1234567890
    ];
});


$factory->define(Addon::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->randomElement(['plans', 'brands','users', 'reports']),
        'limit' => 100,
        
    ];
});

$factory->define(Pricing::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'plans_count' => $faker->randomElement(['5', '10','15', '20']),
        'brand_count' => $faker->randomElement(['5', '10','15', '20']),
        'users_count' => $faker->randomElement(['5', '10','15', '20']),
        'profile_views' => $faker->randomElement(['5', '10','15', '20']),
        'report_count' => $faker->randomElement(['1', '3','5']),
        'duration' => 12,
        'data_renewal_frequency' => 3,
        'start_at' =>  $faker->dateTime(1562750746),
        'ends_at' => $faker->dateTime(1562750746)
        
    ];
});



