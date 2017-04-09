<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViolationTypeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('violation_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('service_id');
            $table->integer('duration');
            $table->text('desc');
            $table->integer('max_amount');
            $table->integer('amount');
            $table->integer('min_amount');
            $table->integer('health_env_type_id');
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
        Schema::drop('violation_type');
    }

}
