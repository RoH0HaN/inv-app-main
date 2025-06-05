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
        Schema::create('expense_payments', function (Blueprint $table) {
            $table->id();

            // -- to identify which expense entry this payment belongs to
            $table->unsignedBigInteger('expense_id');
            $table->foreign('expense_id')
                ->references('id')->on('expenses')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('note', 255)->nullable();
            $table->double('amount');
            $table->string('reference_number', 50);
            $table->string('payment_type', 50);

            // -- Indexes for faster querying
            $table->index('expense_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_payments');
    }
};
