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
        Schema::create('credit_note_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('referral_number', 30)->unique();
            $table->double('amount');
            $table->date('date');
            $table->string('particular', 255);
            $table->double('tcs_tds'); // eg: 0.05, 0.02
            $table->string('note', 255)->nullable();

            // -- based on this type of credit note some decision will be taken
            $table->enum('credit_note_type', ['sale_out_cn', 'price_drop_cn']);

            // -- to identify the supplier of the debit note, foreign key to suppliers table added
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->onUpdate('set null')->onDelete('set null');

            // -- to identify who created this document, foreign key to user table added
            $table->unsignedBigInteger('created_by_id')->nullable(); 
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('set null')->onDelete('set null');

            // -- Indexes for faster querying
            $table->index('created_by_id');
            $table->index('supplier_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_note_transactions');
    }
};
