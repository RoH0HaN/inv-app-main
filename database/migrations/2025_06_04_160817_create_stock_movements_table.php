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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();

            // Stock reference fields
            $table->enum('stock_type', ['batch', 'imei_serial']);

            // FK to either batch_stocks.id or imei_serial_stocks.id
            $table->unsignedBigInteger('stock_id');
            $table->foreign('stock_id')
                ->references('id')->on('batch_stocks')
                ->onDelete('cascade')->onUpdate('cascade');
            
            // Transaction details
            $table->enum('transaction_type', [
                'purchase', 
                'sale', 
                'purchase_return', 
                'sale_return', 
                'transfer', 
                'adjustment'
            ]);
            
            // -- to identify which item this movement belongs to
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // Quantity (required only for batch; can handle fractions like 0.5 box)
            $table->double('quantity')->nullable();
            
            // Related transaction references
            $table->unsignedBigInteger('related_invoice_id')->nullable(); // FK to invoices/purchase-invoices
            $table->unsignedBigInteger('reference_id')->nullable(); // Link to another transaction (e.g., stock_transfer)
            
            // Location tracking - FROM
            $table->unsignedBigInteger('location_from_id')->nullable();
            $table->string('location_from_type', 20)->nullable(); // 'warehouse', 'outlet', 'supplier', 'customer'
            
            // Location tracking - TO
            $table->unsignedBigInteger('location_to_id')->nullable();
            $table->string('location_to_type', 20)->nullable(); // 'warehouse', 'outlet', 'supplier', 'customer'
            
            // Reason for movement (e.g., "damaged", "return", etc.)
            $table->string('reason',255)->nullable();
            
            // Audit fields
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
                

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
