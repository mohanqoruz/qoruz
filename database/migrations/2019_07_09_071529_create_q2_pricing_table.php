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

            $table->unsignedInteger('plans_count');
            $table->unsignedInteger('report_count');
            $table->unsignedInteger('brand_count');
            $table->unsignedInteger('users_count');
            $table->unsignedInteger('profile_views');
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
