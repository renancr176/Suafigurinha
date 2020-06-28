<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumOrderClientDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_order_client_data', function (Blueprint $table) {
            $table->foreignId('album_order_id')->constrained();
            $table->primary('album_order_id');
            $table->string('client_name');
            $table->string('email', 50);
            $table->string('phone_number', 15);
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
        Schema::dropIfExists('album_order_client_data');
    }
}
