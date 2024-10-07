<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanktansactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banktransactions', function (Blueprint $table) {
            $table->increments('bt_ID');
            $table->string('bkvr_no');
            $table->string('acc_title');
            $table->string('acc_number');
            $table->string('bt_cqnumber');
            $table->string('bt_cqdate');
            $table->string('bt_sno');
            $table->string('ex_ID');
            $table->string('ex_name');
            $table->string('bt_description');
            $table->string('bt_amount');
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
        Schema::dropIfExists('banktransactions');
    }
}
