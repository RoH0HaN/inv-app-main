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
        Schema::create('payment_outs', function (Blueprint $table) {
            $table->id();
            
            // -- To store the information about to whom this payment is made
            $table->json('party_details');
            $table->string('particular', 50); // why this entry is created
            $table->string('voucher_type', 50); // for what entity this amount is for
            $table->string('voucher_number');

            $table->string('source_type', 50); // eg: 'purchase', 'refund', 'expense', 'transfer', 'other'
            $table->unsignedBigInteger('source_id')->nullable(); // if available, eg: purchase_id

            $table->enum('payment_method', ['cash', 'card', 'upi', 'bank_transfer', 'cheque', 'credit_adjustment']);

            // -- to identify at which account this amount is debited
            $table->unsignedBigInteger('bank_account_id');
            $table->foreign('bank_account_id')
                ->references('id')->on('bank_accounts')
                ->onDelete('cascade')->onUpdate('cascade');
            
            $table->double('amount');

            $table->json('payment_details')->nullable(); // Optional JSON to store dynamic data (UPI ID, card number, etc.)

            $table->string('note', 255)->nullable();

            // -- to identify at what location this amount is debited
            $table->enum('paid_from_location_type', ['warehouse', 'outlet']);
            $table->unsignedBigInteger('paid_from_location_id');

            // -- to identify which user is responsible for this amount
            $table->unsignedBigInteger('paid_by_id');
            $table->foreign('paid_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('paid_at');

            // -- indexes for faster queries
            $table->index('voucher_type');
            $table->index('paid_from_location_id');
            $table->index('paid_by_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_outs');
    }
};
