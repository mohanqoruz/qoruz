<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2UserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_user_roles', function (Blueprint $table) {
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->timestamps();

            $table->unique(['account_id','user_id','role_id']);

            $table->foreign('account_id')->references('id')->on('q2_accounts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('q2_users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('q2_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q2_user_roles');
    }
}
