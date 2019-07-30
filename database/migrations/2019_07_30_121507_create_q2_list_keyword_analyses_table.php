<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2ListKeywordAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_list_keyword_analyses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('list_id');
            $table->unsignedInteger('profile_id');
            $table->unsignedInteger('list_keyword_id');
            $table->integer('instagram_mentions')->default(0);
            $table->integer('twitter_mentions')->default(0);
            $table->integer('facebook_mentions')->default(0);
            $table->integer('youtube_mentions')->default(0);
            $table->integer('blog_mentions')->default(0);
            $table->timestamps();


            $table->unique(['profile_id','list_keyword_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_keyword_analyses');
    }
}
