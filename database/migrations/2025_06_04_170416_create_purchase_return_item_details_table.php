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
        Schema::create('purchase_return_item_details', function (Blueprint $table) {
            $table->id();

            // -- Link to the parent purchase return item
            $table->unsignedBigInteger('purchase_return_item_id');
            $table->foreign('purchase_return_item_id')
                ->references('id')->on('purchase_return_items')
                ->onDelete('cascade')->onUpdate('cascade');

            // Stock reference
            $table->unsignedBigInteger('stock_id');
            $table->foreign('stock_id')
                ->references('id')->on('batch_stocks')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('quantity');

            
            $table->enum('stock_type',['batch', 'imei_serial']);

            $table->string('imei_serial_number', 50);

            $table->double('purchase_price');

            // indexes for faster querying
            $table->index('purchase_return_item_id');
            $table->index('stock_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_return_item_details');
    }
};
