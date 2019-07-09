<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('phone');
            $table->enum('gender', ['male', 'female', 'other']); 
            $table->string('profile_image')->nullable();

            $table->dateTime('email_verified_at')->nullable();
            $table->dateTime('phone_verified_at')->nullable(); 

            $table->boolean('is_admin')->default('0');  
            $table->boolean('is_active')->default('0'); 
            $table->unsignedInteger('created_by')->nullable(); //user_id
            
            $table->rememberToken();
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
        Schema::dropIfExists('q2_users');
    }
}
