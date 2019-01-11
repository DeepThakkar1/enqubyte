<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesmanIncentivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesman_incentives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->default(0);
            $table->integer('enquiry_id')->default(0);
            $table->integer('invoice_id')->default(0);
            $table->double('incentive_amount')->nullable();
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
        Schema::dropIfExists('salesman_incentives');
    }
}
