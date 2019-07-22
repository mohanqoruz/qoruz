<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2AccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type', ['brand', 'agency', 'api', 'whitelabel', 'startup']);
            $table->enum('status', ['trialing', 'active', 'suspended', 'deleted']);
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
        Schema::dropIfExists('q2_accounts');
    }
}
