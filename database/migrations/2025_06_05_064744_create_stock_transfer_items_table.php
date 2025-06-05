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
        Schema::create('stock_transfer_items', function (Blueprint $table) {
            $table->id();

            // -- to identify which stock transfer this item belongs to
            $table->unsignedBigInteger('stock_transfer_id');
            $table->foreign('stock_transfer_id')
                ->references('id')->on('stock_transfers')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- to identify which item is being transferred
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->enum('tracking_type', ['batch', 'imei_serial']);
            $table->integer('quantity')->nullable(); // Only for batch tracking

            // indexes for faster queries
            $table->index('stock_transfer_id');
            $table->index('item_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfer_items');
    }
};
