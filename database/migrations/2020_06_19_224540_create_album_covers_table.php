<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_covers', function (Blueprint $table) {
            $table->foreignId('album_page_id')->constrained();
            $table->foreignId('album_cover_type_id')->constrained();
            $table->string('image_path')->unique();
            $table->timestamps();

            $table->unique(['album_page_id', 'album_cover_type_id'], 'uk_cover_x_cover_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_covers');
    }
}
