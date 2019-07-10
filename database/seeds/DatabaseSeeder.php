<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        factory(App\Accounts\Models\Account::class, 5)->create();
        factory(App\Subscriptions\Models\Addon::class, 5)->create();
        factory(App\Subscriptions\Models\Pricing::class, 3)->create();
    }
}
