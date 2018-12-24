<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquiry_id')->default(0)->unsigned();
            $table->integer('product_id')->default(0)->unsigned();
            $table->text('description')->nullable();
            $table->integer('qty')->default(0);
            $table->double('price')->default(0);
            $table->integer('tax')->default(0);
            $table->double('product_tot_amt')->default(0);
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
        Schema::dropIfExists('enquiry_items');
    }
}
