<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_visit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id');
            $table->integer('res_quar_id');
            $table->integer('street_id');
            $table->integer('facility_id');
            $table->integer('facility_status_id');
            $table->date('date');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_visit');
    }
}
