<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('owner');
            $table->string('path', 100)->unique();
            $table->string('thumbnailPath', 100);
            $table->string('title', 100);
            $table->text('description');
            $table->boolean('public');
            $table->boolean('blocked');
            $table->dateTime('uploadDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
