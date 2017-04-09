<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('facility', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_name');
            $table->string('township');
            $table->integer('res_quar_id')->nullable();
            $table->integer('street_id')->nullable();
            $table->string('lyc_name');
            $table->integer('computer_number');
            $table->integer('lyc_number');
            $table->integer('build_number');
            $table->integer('company_id')->nullable();
            $table->integer('activity_type_id')->nullable();
            $table->integer('labour_number');
            $table->string('owner_name');
            $table->integer('owner_id');
            $table->boolean('lyc_status');
            $table->date('lyc_start');
            $table->date('lyc_end');
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
        Schema::drop('facility');
    }

}
