<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2AddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_addons', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->enum('type', ['plans', 'brands', 'users','reports','profiles']);
            $table->unsignedInteger('limit');

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
        Schema::dropIfExists('q2_addons');
    }
}
