<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedDecimal('amount')->default(0);
            $table->unsignedDecimal('quantity', 15, 6);
            $table->unsignedDecimal('purchase_price', 15, 10);
            $table->dateTime('purchase_date');
            $table->boolean('sold')->default(0);
            $table->unsignedDecimal('selling_amount')->nullable();
            $table->unsignedDecimal('selling_price', 15, 10)->nullable();
            $table->dateTime('selling_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
