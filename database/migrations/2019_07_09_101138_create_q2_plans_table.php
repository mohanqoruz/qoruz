<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2PlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_plans', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('slug')->unique()->nullable();

            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('owner_id');
            $table->unsignedInteger('pricing_id');

            $table->bigInteger('type');
            $table->jsonb('platforms');
            $table->string('plan_optimizer');
            $table->bigInteger('optimizer_value');
            $table->string('status');    

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
        Schema::dropIfExists('q2_plans');
    }
}
