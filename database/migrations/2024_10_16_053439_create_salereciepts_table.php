<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalerecieptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salereciepts', function (Blueprint $table) {
            $table->id('sr_id'); // Primary key with auto-increment
            $table->string('sr_no');
            $table->string('customer_name');
            $table->string('sr_invoice');
            $table->string('sr_head');
            $table->text('sr_description')->nullable();
            $table->integer('amount');
            $table->integer('balance');
            $table->string('sr_preparedby');
            $table->string('fyear');
            $table->timestamps(); // To include created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salereciepts');
    }
}
