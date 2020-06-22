<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumPageTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_page_texts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('font_id');
            $table->text('text');
            $table->integer('font_size');
            $table->boolean('bold');
            $table->boolean('italic');
            $table->boolean('underlined');
            $table->integer('width');
            $table->integer('height');
            $table->integer('x_position');
            $table->integer('y_position');
            $table->integer('rotation');
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
        Schema::dropIfExists('album_page_texts');
    }
}
