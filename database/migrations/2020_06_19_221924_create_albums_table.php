<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('ref_code')->unique();
            $table->string('title');
            $table->decimal('price')->default(0);
            $table->text('description')->nullable();
            $table->boolean('have_bookbinding_options');

            $table->unsignedBigInteger('presentation_page_type_id');
            $table->unsignedBigInteger('print_page_type_id');
            $table->unsignedBigInteger('presentation_cover_page_type_id')->nullable();
            $table->unsignedBigInteger('print_cover_page_type_id')->nullable();
            $table->unsignedBigInteger('album_frame_type_id');
            $table->decimal('print_cut_space')->default(0);
            $table->string('background_color_firgure_grid', 7)->default('#FFFFFF');

            $table->boolean('active');
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
        Schema::dropIfExists('albums');
    }
}
