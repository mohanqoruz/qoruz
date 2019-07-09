<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2AccountCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_account_countries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('account_id');
            $table->unsignedInteger('country_id');
            $table->boolean('is_primary')->default(0);
            $table->boolean('is_active')->default(0);

            $table->unique(['account_id','country_id']);
            $table->foreign('account_id')->references('id')->on('q2_accounts')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q2_account_countries');
    }
}
