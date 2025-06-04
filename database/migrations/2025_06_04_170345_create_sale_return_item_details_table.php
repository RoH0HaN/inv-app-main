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
        Schema::create('sale_return_item_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sale_return_item_id');
            $table->foreign('sale_return_item_id')
                ->references('id')->on('sale_return_items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('stock_id'); // batch_stocks.id or imei_serial_stocks.id
            $table->string('imei_serial_number', 50)->nullable(); // if imei_serial_stocks.id
            
            $table->integer('quantity');

            // -- original purchase price of this returned item
            $table->double('purchase_price');

            // -- original sale price of this returned item
            $table->double('sale_price');

            $table->double('tax_rate');
            $table->double('discount');

            // -- indexes for faster querying
            $table->index('sale_return_item_id');
            $table->index('stock_id');
            $table->index('imei_serial_number');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_return_item_details');
    }
};
