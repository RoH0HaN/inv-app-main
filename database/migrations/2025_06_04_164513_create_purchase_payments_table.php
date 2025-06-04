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
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->id();
 
            // -- Link to the parent purchase
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')
                ->references('id')->on('purchases')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // Payment method used
            $table->enum('payment_method', [
                'cash', 
                'card', 
                'upi', 
                'bank_transfer', 
                'credit'
            ]);
            
            // Amount paid via this method
            $table->double('amount');
            
            // Notes for clarity (e.g., UPI ref, card name)
            $table->string('note', 255);
            
            // Extra details in JSON (e.g., bank ref no., UPI ID, etc.)
            $table->json('payment_details')->nullable();

            // index
            $table->index('purchase_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_payments');
    }
};
