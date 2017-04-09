<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('street', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('res_quar_id')->nullable();
            $table->text('desc');
            $table->string('map');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();

            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('street');
    }
}
