<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViolationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('violation', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('code');
            $table->integer('res_quar_id');
            $table->integer('street_id');
            $table->integer('service_id');
            $table->integer('violation_type_id');
            $table->integer('violation_status_id');
            $table->integer('penalty_id');
            $table->integer('custom_penalty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('violation');
    }
}
