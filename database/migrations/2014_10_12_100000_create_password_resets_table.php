<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        /*Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });*/
=======
        // Schema::create('password_resets', function (Blueprint $table) {
        //     $table->string('email')->index();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });
>>>>>>> a3b790c9c12635c8f00446ff4082f28f384594ea
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD
        //Schema::dropIfExists('password_resets');
=======
        // Schema::dropIfExists('password_resets');
>>>>>>> a3b790c9c12635c8f00446ff4082f28f384594ea
    }
}
