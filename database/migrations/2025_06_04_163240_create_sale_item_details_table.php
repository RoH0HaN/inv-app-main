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
        Schema::create('sale_item_details', function (Blueprint $table) {
            $table->id();

            // -- to identify which sale item this detail is belongs to
            $table->unsignedBigInteger('sale_item_id');
            $table->foreign('sale_item_id')
                ->references('id')->on('sale_items')
                ->onDelete('cascade')->onUpdate('cascade');

            // Note: No foreign key constraint for stock_id as it might reference different tables
            // based on stock_type (imei_serial vs batch tables)
            $table->unsignedBigInteger('stock_id');
            $table->enum('stock_type', ['imei_serial', 'batch']);

            $table->integer('quantity')->default(1); // the default is for IMEI serials only
            $table->enum('unit_type', ['primary', 'secondary']); // eg: primary, secondary (for batches)
            $table->double('unit_price');

            // -- indexes for faster queries
            $table->index('sale_item_id');
            $table->index('stock_id');
            $table->index('stock_type');
            $table->index(['stock_id', 'stock_type']); // Composite index for combined queries

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_item_details');
    }
};
