<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2PricingAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_pricing_addons', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('pricing_id');
            $table->unsignedInteger('addon_id');
            $table->unsignedInteger('added_by');

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
        Schema::dropIfExists('q2_pricing_addons');
    }
}
