<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->default(0)->unsigned();
            $table->integer('employee_id')->default(0)->unsigned();
            $table->integer('store_id')->default(0)->unsigned();
            $table->integer('customer_id')->default(0)->unsigned();
            $table->integer('enquiry_id')->default(0)->unsigned();
            $table->string('invoice_date')->nullable();
            $table->string('due_date')->nullable();
            $table->double('sub_tot_amt')->default(0)->unsigned();
            $table->double('grand_total')->default(0)->unsigned();
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
        Schema::dropIfExists('invoices');
    }
}
