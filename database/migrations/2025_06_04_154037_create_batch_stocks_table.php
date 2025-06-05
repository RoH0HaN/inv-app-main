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
        Schema::create('batch_stocks', function (Blueprint $table) {
            $table->id();

             // -- to identify which item this batch belongs to
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')  
                ->references('id')->on('items')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // -- to identify which supplier this batch came from
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->onDelete('cascade')->onUpdate('cascade');
                
            $table->string('model', 50);
            
            // Pricing fields
            $table->double('sell_price');
            $table->boolean('sell_price_tax_status');
            $table->double('purchase_price');
            $table->boolean('purchase_price_tax_status');
            $table->double('tax_rate');
            $table->string('tax_type', 20);
            $table->double('discount');
            $table->string('discount_type', 30);
            $table->double('mrp');
            $table->double('msp');
            
            // Product attributes
            $table->string('color', 20);
            $table->string('size', 20);
            
            // Quantity management
            $table->integer('quantity_primary')->default(0);
            $table->integer('quantity_secondary')->default(0);
            
            // Unit management
            $table->unsignedBigInteger('primary_unit_id');
            $table->foreign('primary_unit_id')
                ->references('id')->on('units')
                ->onDelete('cascade')->onUpdate('cascade');
                
            $table->unsignedBigInteger('secondary_unit_id')->nullable();
            $table->foreign('secondary_unit_id')
                ->references('id')->on('units')
                ->onDelete('cascade')->onUpdate('cascade');
                
            $table->integer('conversion_rate')->default(1);
            
            // -- main unit for this batch (e.g., Box, Kg)
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')
                ->references('id')->on('units')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // Location management
            $table->unsignedBigInteger('location_id');
            $table->string('location_type', 20);
            
            // Batch identification
            $table->string('batch_number', 50);
            
            // Status tracking
            $table->enum('status', ['available', 'sold']);

            // -- Indexes for better performance
            $table->index('supplier_id');
            $table->index('item_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_stocks');
    }
};
