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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            
            $table->string('name',50);
            $table->string('hsn_code',50);
            $table->string('sku_code',50);

            // -- to identify which brand this product belongs to
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')
                ->references('id')->on('brands')
                ->onDelete('cascade')->onUpdate('cascade');

            // -- to identify which category this product belongs to
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade');

            // -- to identify which supplier this product belongs to
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('description', 127);
        
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
            
            // Inventory tracking
            $table->enum('tracking_type', ['batch', 'IMEI_serial']);
            $table->integer('min_stock');
            
            // Unit management with these two foreign keys
            $table->unsignedBigInteger('primary_unit_id');
            $table->foreign('primary_unit_id')
                ->references('id')->on('units')
                ->onDelete('cascade')->onUpdate('cascade');
                
            $table->unsignedBigInteger('secondary_unit_id')->nullable();
            $table->foreign('secondary_unit_id')
                ->references('id')->on('units')
                ->onDelete('cascade')->onUpdate('cascade');
                
            $table->integer('conversion_rate')->default(1);
            
            // -- to identify who created this document, foreign key to user table added
            $table->unsignedBigInteger('created_by_id'); 
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

             // -- Indexes for better performance
            $table->index('supplier_id');
            $table->index('brand_id');
            $table->index('primary_unit_id');
            $table->index('secondary_unit_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
