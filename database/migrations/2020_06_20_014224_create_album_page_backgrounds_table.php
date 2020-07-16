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
            $table->unsignedBigInteger('album_page_id');
            $table->integer('sequence');
            $table->decimal('width');
            $table->decimal('height');
            $table->decimal('x_position');
            $table->decimal('y_position');
            $table->decimal('rotation');
            $table->string('controls_position');
            $table->timestamps();

            $table->unique(['album_page_id', 'sequence']);
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
