<?php

use App\Subscriptions\Models\Pricing;

use Illuminate\Database\Seeder;

class PricingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //basic
        $price = Pricing::create([
             'name' => 'Basic', 
             'slug' => 'basic',
             'description' => 'Hic excepturi sit ab voluptatibus
             provident voluptatum aliquam. Cumque dolor velit 
             voluptas beatae.',
             'plans_count' => 10,
             'report_count' => 3,
             'brand_count' => 5,
             'users_count' => 50,
             'profile_views' => 50,
             'is_audience_searchable' => 0,
             'is_access_registered_influencers' => 0,
             'is_view_insights' => 0,
             'is_filterable' => 0,
             'is_competation_check' => 0,
             'report_refresh' => 0,
             'data_renewal_frequency' => 3,
             'duration' => 12,
             'start_at' => '2019-06-12 09:30:48',
             'ends_at' => '2019-08-12 09:30:48'
             
        ]);
        //advanced
        $price = Pricing::create([
            'name' => 'Advanced', 
            'slug' => 'advanced',
            'description' => 'Hic excepturi sit ab voluptatibus
            provident voluptatum aliquam. Cumque dolor velit 
            voluptas beatae.',
            'plans_count' => 20,
            'report_count' => 6,
            'brand_count' => 10,
            'users_count' => 100,
            'profile_views' => 100,
            'is_audience_searchable' => 1,
            'is_access_registered_influencers' => 0,
            'is_view_insights' => 0,
            'is_filterable' => 0,
            'is_competation_check' => 0,
            'report_refresh' => 0,
            'data_renewal_frequency' => 3,
            'duration' => 18,
            'start_at' => '2019-06-12 09:30:48',
            'ends_at' => '2019-08-12 09:30:48'
            
       ]);
        //premium
       $price = Pricing::create([
        'name' => 'Premium', 
        'slug' => 'premium',
        'description' => 'Hic excepturi sit ab voluptatibus
        provident voluptatum aliquam. Cumque dolor velit 
        voluptas beatae.',
        'plans_count' => 30,
        'report_count' => 9,
        'brand_count' => 15,
        'users_count' => 150,
        'profile_views' => 150,
        'is_audience_searchable' => 1,
        'is_access_registered_influencers' => 1,
        'is_view_insights' => 1,
        'is_filterable' => 1,
        'is_competation_check' => 1,
        'report_refresh' => 1,
        'data_renewal_frequency' => 3,
        'duration' => 12,
        'start_at' => '2019-06-12 09:30:48',
        'ends_at' => '2019-08-12 09:30:48'
        
   ]);
    }
}
