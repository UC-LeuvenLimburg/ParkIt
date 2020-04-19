<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentables', function (Blueprint $table) {
            $table->id(); //rentable_id
            $table->integer('user_id'); //owner
            $table->string('adress');
            $table->string('postal_code');
            $table->date('date_of_hire');
            $table->time('start_time_rp');
            $table->time('end_time_rp');
            $table->double('price');
            $table->string('bankaccount_nr');
            $table->string('description');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentables');
    }
}
