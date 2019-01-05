<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderRecordPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_record_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_order_id')->default(0);
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
        Schema::dropIfExists('purchase_order_record_payments');
    }
}
