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
        Schema::create('payment_ins', function (Blueprint $table) {
            $table->id();

            // -- To store the information about from whom received payment
            $table->json('party_details');
            $table->string('particular', 50); // why this entry is created
            $table->string('voucher_type', 50); // for what entity this amount is for
            $table->string('voucher_number');

            $table->string('source_type', 50); // eg: 'sale', 'finance', 'exchange', 'other'
            $table->unsignedBigInteger('source_id')->nullable(); // if available, eg: sale_id

            $table->enum('payment_method', ['cash', 'card', 'upi', 'bank_transfer', 'finance', 'exchange']);

            // -- to identify at which account this amount is credited
            $table->unsignedBigInteger('bank_account_id');
            $table->foreign('bank_account_id')
                ->references('id')->on('bank_accounts')
                ->onDelete('cascade')->onUpdate('cascade');
            
            $table->double('amount');

            $table->json('payment_details')->nullable(); // Optional JSON to store dynamic data (UPI ID, card number, etc.)

            $table->string('note', 255)->nullable();

            // -- to identify at what location this amount is received
            $table->enum('received_at_location_type', ['warehouse', 'outlet']);
            $table->unsignedBigInteger('received_at_location_id');

            // -- to identify which user is responsible for this amount
            $table->unsignedBigInteger('received_by_id');
            $table->foreign('received_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('received_at');

            // -- indexes for faster queries
            $table->index('voucher_type');
            $table->index('received_at_location_id');
            $table->index('received_by_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_ins');
    }
};
