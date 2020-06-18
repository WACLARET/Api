<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUssdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ussds', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('session_id')->unique();
            // $table->Integer('customeridnumber')->unique();msisdn

            $table->char('msisdn')->unique();
            // $table->char('customermobilenumber');Amount

            // $table->char('loanproduct');
            $table->integer('Amount');
            // $table->integer('loanamount');id_number

            $table->char('id_number');
            // $table->char('loanterm');confirm

            $table->char('confirm');
            // $table->char('customerfullnames');

            $table->char('loanapplicationdate');
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
        Schema::dropIfExists('ussds');
    }
}
