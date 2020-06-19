<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('customeridnumber');
            $table->char('customermobilenumber');
            $table->char('loanproduct');
            $table->integer('loanamount');
            $table->integer('loanbalance');
            $table->char('loanstatus');
            $table->char('reference');
            $table->char('loanduedate');
            $table->char('loanterm');
            $table->char('customerfullnames');
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
        Schema::dropIfExists('statuses');
    }
}
