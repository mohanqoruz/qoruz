<?php
use App\Subscriptions\Models\Addon;

use Illuminate\Database\Seeder;

class AddonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //100 profiles
        $addon = Addon::create([
            'name' => 'Profile Addon',
            'slug' => 'profileaddon100',
            'type' => 'profiles',
            'limit' => '100'
        ]);

         //20 Reports
         $addon = Addon::create([
            'name' => 'Report Addon',
            'slug' => 'reportaddon20',
            'type' => 'reports',
            'limit' => '20'
        ]);

         //5 Brands
         $addon = Addon::create([
            'name' => 'Brands Addon',
            'slug' => 'brandsaddon5',
            'type' => 'brands',
            'limit' => '5'
        ]);

         //100 users
         $addon = Addon::create([
            'name' => 'Users Addon',
            'slug' => 'usersaddon100',
            'type' => 'users',
            'limit' => '100'
        ]);

        //30 plans
        $addon = Addon::create([
            'name' => 'Plans Addon',
            'slug' => 'plansaddon30',
            'type' => 'plans',
            'limit' => '30'
        ]);

    }
}
