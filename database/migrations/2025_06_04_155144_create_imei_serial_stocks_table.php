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
        Schema::create('imei_serial_stocks', function (Blueprint $table) {
            $table->id();

                    
            // -- to identify which item this IMEI/serial belongs to
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // -- to identify which supplier this IMEI/serial came from
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // Unique identifier for individual items
            $table->string('imei_serial_number', 50);
            
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
            
            // Location management
            $table->unsignedBigInteger('location_id');
            $table->string('location_type', 20);
            
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
        Schema::dropIfExists('imei_serial_stocks');
    }
};
