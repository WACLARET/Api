<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advances', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('session_id')->unique();
            $table->char('msisdn')->unique();
            $table->char('status')->default('CURRENT');
            $table->integer('Amount');
            $table->char('id_number');
            $table->char('description');
            $table->integer('loanterm');
            $table->char('confirm');
            $table->char('refno');
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
        Schema::dropIfExists('advances');
    }
}
