<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumFrameTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_frame_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('font_id');
            $table->string('title');
            $table->integer('font_size');
            $table->string('image_path');
            $table->decimal('width');
            $table->decimal('height');
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
        Schema::dropIfExists('album_frame_types');
    }
}
