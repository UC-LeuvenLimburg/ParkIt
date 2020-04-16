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
            $table->id();//rentable_id
            $table->int('user_id');//owner
            $table->varchar('adress');
            $table->varchar('postal_code');
            $table->date('date_of_hire');
            $table->time('start_time_rp');
            $table->time('end_time_rp');
            $table->double('price/h');
            $table->varchar('bankaccount_nr');
            $table->varchar('decription');
            
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
