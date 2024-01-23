<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_lists', function (Blueprint $table) {
            $table->id();
            $table->string('paymentID');
            $table->string('createTime');//It would be Date time format
            $table->string('updateTime');//It would be Date time format
            $table->string('trxID')->nullable();
            $table->string('transactionStatus')->nullable();
            $table->double('amount',15,2)->default(0);
            $table->string('currency')->nullable();
            $table->string('intent')->nullable();
            $table->string('merchantInvoiceNumber')->nullable();
            $table->string('customerMsisdn')->nullable();
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
        Schema::dropIfExists('transaction_lists');
    }
};
