<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2AccountPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_account_pricings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('account_id');
            $table->unsignedInteger('plan_id');

            $table->boolean('auto_renewal')->default('0');

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
        Schema::dropIfExists('q2_account_pricings');
    }
}
