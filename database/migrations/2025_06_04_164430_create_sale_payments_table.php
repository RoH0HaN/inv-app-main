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
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();

            // -- to identify which sale this payment is belongs to
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')
                ->references('id')->on('sales')
                ->onDelete('cascade');

            $table->enum('payment_type', ['cash', 'card', 'upi', 'emi', 'exchange', 'credit']);
            $table->double('amount');
            $table->string('note', 255)->nullable();

            // -- store the payment-method specific details here
            $table->json('payment_details')->nullable();

            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();

            // -- indexes for faster queries
            $table->index('sale_id');
            $table->index('payment_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_payments');
    }
};
