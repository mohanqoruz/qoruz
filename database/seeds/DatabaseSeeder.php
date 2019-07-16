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
        $this->call(AccountTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PricingTableSeeder::class);
        $this->call(AddonsTableSeeder::class);

        // factory(App\Accounts\Models\Account::class, 5)->create();
        // factory(App\Subscriptions\Models\Addon::class, 5)->create();
        // factory(App\Subscriptions\Models\Pricing::class, 3)->create();
        //factory(App\Plan\Models\Plan::class, 3)->create();
    }
}
