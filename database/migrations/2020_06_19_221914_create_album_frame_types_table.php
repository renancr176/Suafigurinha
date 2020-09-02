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
            $table->string('image_path');
            $table->decimal('width');
            $table->decimal('height');
            $table->decimal('font_size');
            $table->decimal('x_position');
            $table->decimal('y_position');
            $table->unsignedBigInteger('print_page_type_id');
            $table->integer('quantity_rows_by_page');
            $table->integer('quantity_figures_by_row');
            $table->decimal('margin_width');
            $table->decimal('margin_height');
            $table->decimal('space_between_figures');
            $table->decimal('container_border_space');
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
