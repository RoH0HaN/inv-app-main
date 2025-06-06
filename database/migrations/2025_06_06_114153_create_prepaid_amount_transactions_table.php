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
        Schema::create('prepaid_amount_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('referral_number', 30)->unique();
            $table->double('amount');
            $table->date('date');
            $table->string('particular', 255);
            $table->double('tcs_tds'); // eg: 0.05, 0.02
            $table->string('note', 255)->nullable();

            // -- to identify the customer of the prepaid amount, foreign key to suppliers table added
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onUpdate('set null')->onDelete('set null');

            // -- to identify who created this document, foreign key to user table added
            $table->unsignedBigInteger('created_by_id')->nullable(); 
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('set null')->onDelete('set null');

            // -- Indexes for faster querying
            $table->index('created_by_id');
            $table->index('customer_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prepaid_amount_transactions');
    }
};
