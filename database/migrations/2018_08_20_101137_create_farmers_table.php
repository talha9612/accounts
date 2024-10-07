<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {

            $table->increments('fr_ID');
            $table->string('fr_name');
            $table->string('fr_fname');
            $table->string('fr_gender');
            $table->string('fr_address');
            $table->integer('fr_cnic');
            $table->integer('fr_phone');
            $table->string('fr_city');
            $table->integer('fr_quota');
            $table->string('fr_quota_validfrom');
            $table->string('fr_quota_validtill');
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
        Schema::dropIfExists('farmers');
    }
}
