<?php

use App\Roles\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Role::create([
            'name' => 'Plan', 
            'slug' => 'plan',
            'permissions' => '{}'
        ]);

        $report = Role::create([
            'name' => 'Report', 
            'slug' => 'report',
            'permissions' => '{}'
        ]);

        $addon = Role::create([
            'name' => 'Addon', 
            'slug' => 'addon',
            'permissions' => '{}'
        ]);
    }
}
