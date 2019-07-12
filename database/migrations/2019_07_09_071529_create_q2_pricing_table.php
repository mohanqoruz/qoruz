<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2PricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_pricing', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('slug')->unique();
            $table->mediumText('description')->nullable(); 

            $table->unsignedInteger('plans_count')->default(0);
            $table->unsignedInteger('report_count')->default(0);
            $table->unsignedInteger('brand_count')->default(0);
            $table->unsignedInteger('users_count')->default(0);
            $table->unsignedInteger('profile_views')->default(0);
            //inclusions
            $table->boolean('is_audience_searchable')->default(0);
            $table->boolean('is_access_registered_influencers')->default(0);
            $table->boolean('is_view_insights')->default(0);
            $table->boolean('is_filterable')->default(0);
            $table->boolean('is_competation_check')->default(0);
            $table->boolean('report_refresh')->default(0);
            
            $table->unsignedInteger('data_renewal_frequency');// in months
            $table->unsignedInteger('duration'); // in months

            $table->dateTime('start_at'); 
            $table->dateTime('ends_at'); 

            $table->timestamps();
            $table->softDeletes();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q2_pricing');
    }
}
