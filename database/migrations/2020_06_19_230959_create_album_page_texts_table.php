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
            $table->unsignedBigInteger('album_page_id');
            $table->unsignedBigInteger('font_id');
            $table->text('text');
            $table->string('color');
            $table->string('alignment');
            $table->integer('font_size');
            $table->boolean('bold');
            $table->boolean('italic');
            $table->boolean('underlined');
            $table->decimal('width');
            $table->decimal('x_position');
            $table->decimal('y_position');
            $table->decimal('rotation');
            $table->string('controls_position');
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
