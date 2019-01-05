<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRemainingAmountInPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->double('remaining_amount')->default(0);
            $table->integer('status')->default(0);
            $table->integer('discount_type')->default(0);
            $table->double('discount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn('remaining_amount');
            $table->dropColumn('status');
            $table->dropColumn('discount_type');
            $table->dropColumn('discount');
        });
    }
}
