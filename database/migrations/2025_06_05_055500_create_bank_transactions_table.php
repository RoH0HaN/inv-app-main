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
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();

            // -- to identify at which account is used
            $table->unsignedBigInteger('bank_account_id');
            $table->foreign('bank_account_id')
                ->references('id')->on('bank_accounts')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('source_type', 50); // eg: 'sale', 'purchase', 'payment_in', 'payment_out', 'adjustment'
            $table->unsignedBigInteger('source_id')->nullable(); // if available, eg: sale_id

            $table->enum('transaction_type', ['in', 'out', 'adjustment']);
            $table->string('method', 50); // eg: 'cash', 'cheque', 'bank_transfer'
            $table->double('amount');

            $table->string('reference_number', 50)->nullable(); // eg: cheque number, bank transfer number
            $table->string('note', 255)->nullable(); // eg: cheque details, bank transfer details, reason for adjustment

            // -- to identify who created this entry
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_transactions');
    }
};
