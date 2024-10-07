<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeahersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('tr_ID');
            $table->string('tr_name');
            $table->string('tr_fname');
            $table->string('tr_gender');
            $table->integer('tr_cnic');
            $table->integer('tr_phone');
            $table->string('tr_address');
            $table->string('tr_city');
            $table->integer('tr_quota');
            $table->string('tr_quota_validfrom');
            $table->string('tr_quota_validtill');
            $table->string('assoc_area');
            $table->string('assoc_city');
            $table->string('assoc_ID');
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
        Schema::dropIfExists('teachers');
    }
}
