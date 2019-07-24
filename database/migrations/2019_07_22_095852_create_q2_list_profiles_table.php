<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2ListProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_list_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('plan_list_id');
            $table->unsignedInteger('profile_id');
            $table->jsonb('facebook_delivariables')->nullable(); 
            $table->jsonb('instagram_delivariables')->nullable(); 
            $table->jsonb('youtube_delivariables')->nullable(); 
            $table->jsonb('twitter_delivariables')->nullable(); 
            $table->jsonb('blog_delivariables')->nullable(); 

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
        Schema::dropIfExists('q2_list_profiles');
    }
}
