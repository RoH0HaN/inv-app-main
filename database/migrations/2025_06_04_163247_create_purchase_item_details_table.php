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
        Schema::create('purchase_item_details', function (Blueprint $table) {
            $table->id();
              
            // -- Link to the parent purchase item
            $table->unsignedBigInteger('purchase_item_id');
            $table->foreign('purchase_item_id')
                ->references('id')->on('purchase_items')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // Stock reference (FK to either batch_stocks or imei_serial_stocks)
            $table->unsignedBigInteger('stock_id');
            
            // Type of stock entry
            $table->enum('stock_type', ['batch', 'imei_serial']);
            
            // Quantity (only applicable for batch items)
            $table->integer('quantity');
            
            // Unit type for the quantity
            $table->enum('unit_type', ['primary', 'secondary']);
            
            // indexes for faster querying
            $table->index('purchase_item_id');
            $table->index('stock_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_item_details');
    }
};
