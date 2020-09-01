<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::enableForeignKeyConstraints();

        Schema::table('albums', function (Blueprint $table) {
            $table->foreign('presentation_page_type_id')
            ->references('id')->on('page_types');
            $table->foreign('print_page_type_id')
            ->references('id')->on('page_types');
            $table->foreign('print_back_front_page_type_id')
            ->references('id')->on('page_types');

            $table->foreign('album_frame_type_id')
            ->references('id')->on('album_frame_types');
        });

        Schema::table('album_pages', function (Blueprint $table) {
            $table->foreign('album_id')
            ->references('id')->on('albums')
            ->onDelete('cascade');
        });

        Schema::table('album_frame_types', function (Blueprint $table) {
            $table->foreign('print_page_type_id')
            ->references('id')->on('page_types');
            $table->foreign('font_id')
            ->references('id')->on('fonts');
        });

        Schema::table('album_page_photos', function (Blueprint $table) {
            $table->foreign('album_page_id')
            ->references('id')->on('album_pages')
            ->onDelete('cascade');
        });

        Schema::table('album_page_texts', function (Blueprint $table) {
            $table->foreign('album_page_id')
            ->references('id')->on('album_pages')
            ->onDelete('cascade');
            $table->foreign('font_id')
            ->references('id')->on('fonts');
        });

        Schema::table('album_page_backgrounds', function (Blueprint $table) {
            $table->foreign('album_page_id')
            ->references('id')->on('album_pages')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('album_page_texts', function (Blueprint $table) {
            $table->dropForeign('album_page_texts_album_page_id_foreign');
            $table->dropForeign('album_page_texts_font_id_foreign');
        });

        Schema::table('album_page_backgrounds', function (Blueprint $table) {
            $table->dropForeign('album_page_backgrounds_album_page_id_foreign');
        });

        Schema::table('album_page_photos', function (Blueprint $table) {
            $table->dropForeign('album_page_photos_album_page_id_foreign');
        });

        Schema::table('album_frame_types', function (Blueprint $table) {
            $table->dropForeign('album_frame_types_font_id_foreign');
        });

        Schema::table('album_pages', function (Blueprint $table) {
            $table->dropForeign('album_pages_album_id_foreign');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->dropForeign('albums_presentation_page_type_id_foreign');
            $table->dropForeign('albums_print_page_type_id_foreign');
            $table->dropForeign('albums_print_back_front_page_type_id_foreign');
            $table->dropForeign('albums_print_figure_grid_page_type_id_foreign');
            $table->dropForeign('albums_album_frame_type_id_foreign');
        });
    }
}
