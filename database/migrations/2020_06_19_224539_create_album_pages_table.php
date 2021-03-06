<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('album_id');
            $table->integer('sequence');
            $table->string('image_path')->unique();
            $table->timestamps();

            $table->unique(['album_id', 'sequence'], 'uk_album_sequence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_pages');
    }
}
