<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phonepe_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->nullable();
            $table->string('merchant_user_id')->nullable();
            $table->string('merchant_transaction_id')->unique()->nullable();
            $table->string('transaction_id')->unique()->nullable();  #It will come after payment success
            $table->string('order_id')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('payment_done', ['No', 'Yes'])->nullable();
            $table->enum('code', ['SYSTEM_CAPTURE', 'PAYMENT_INITIATED', 'PAYMENT_SUCCESS', 'PAYMENT_ERROR', 'INTERNAL_SERVER_ERROR', 'BAD_REQUEST', 'AUTHORIZATION_FAILED'])->default('SYSTEM_CAPTURE');   #SYSTEM_CAPTURE this is for first time capture data into our system
            $table->text('message',)->nullable();
            $table->string('payment_method')->nullable();
            $table->json('response_data')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phonepe_transactions');
    }
};
