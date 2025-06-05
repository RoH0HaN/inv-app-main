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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            
             // -- Link to the parent purchase
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('purchase_id')
                ->references('id')->on('purchases') 
                ->onDelete('cascade')->onUpdate('cascade');
                
            // -- Item being purchased
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // Quantity and pricing
            $table->integer('quantity');      // Quantity of the item
            $table->double('price');          // Unit price of the item (without tax)
            $table->double('discount');       // Discount applied to this item
            $table->double('tax');            // Tax amount for this item
            $table->double('total');          // Total amount = (quantity × price) - discount + tax
            
            // Type of tracking used for the item
            $table->enum('tracking_type', ['batch', 'imei_serial']);

            // indexes for faster querying
            $table->index('purchase_id');
            $table->index('item_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
