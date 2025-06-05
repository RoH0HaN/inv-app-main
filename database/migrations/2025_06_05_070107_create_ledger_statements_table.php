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
        Schema::create('ledger_statements', function (Blueprint $table) {
            $table->id();

            $table->date('date'); // Date of transaction

            // -- party information (customer, supplier, etc.)
            $table->unsignedBigInteger('party_id');
            $table->enum('party_type', ['customer', 'supplier']);

            $table->string('party_name', 100); // Denormalized for reports
            $table->string('particular', 255); // Custom or auto-generated detail
            $table->string('voucher_type', 50); // sale, purchase, payment, etc.
            $table->string('voucher_number', 50); // e.g., INV123, REC456
            $table->double('debit')->default(0); // Amount paid/spent
            $table->double('credit')->default(0); // Amount received

            // -- to identify who created this entry
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            // indexes for faster queries
            $table->index('party_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledger_statements');
    }
};
