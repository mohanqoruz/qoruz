<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2SubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('pricing_id');
            $table->unsignedInteger('account_id');

            $table->unsignedInteger('plans_count');
            $table->unsignedInteger('reports_count');
            $table->unsignedInteger('brands_count');
            $table->unsignedInteger('users_count');
            $table->unsignedInteger('profiles_count'); // prfile views

            //inclusions
            $table->boolean('is_audience_searchable')->default(0);
            $table->boolean('is_access_registered_influencers')->default(0);
            $table->boolean('is_view_insights')->default(0);
            $table->boolean('is_filterable')->default(0);
            $table->boolean('is_competation_check')->default(0);
            $table->boolean('report_refresh')->default(0);

            $table->dateTime('start_at'); 
            $table->dateTime('ends_at'); 

            $table->boolean('status')->default('1');  

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
        Schema::dropIfExists('q2_subscriptions');
    }
}
