<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->default(0);
            $table->string('payment_date')->nullable();
            $table->double('amount')->default(0);
            $table->integer('payment_method')->default(0);
            $table->integer('payment_account')->default(0);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('record_payments');
    }
}
