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
        $tableName = 'albums';

        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->integer('page_type_id')->unsigned();
            $table->string('ref_code')->unique();
            $table->string('title');
            $table->decimal('price');
            $table->text('description');
            $table->string('page_orientation');
            $table->timestamps();
        });

        Schema::table($tableName, function (Blueprint $table) {
            $table->foreign('page_type_id')
            ->references('id')->on('page_types')
            ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
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
