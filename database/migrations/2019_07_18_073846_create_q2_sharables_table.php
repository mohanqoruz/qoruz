<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQ2SharablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q2_sharables', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('share_by');
            $table->unsignedInteger('share_to');
            $table->morphs('sharable');
            $table->jsonb('permissions')->nullable(); 
            $table->string('token');
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('q2_sharables');
    }
}
