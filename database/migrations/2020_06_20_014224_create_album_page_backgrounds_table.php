<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumPageBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_page_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->decimal('width');
            $table->decimal('height');
            $table->decimal('x_position');
            $table->decimal('y_position');
            $table->decimal('rotation');
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
        Schema::dropIfExists('album_page_backgrounds');
    }
}
