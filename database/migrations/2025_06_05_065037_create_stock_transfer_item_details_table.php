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
        Schema::create('stock_transfer_item_details', function (Blueprint $table) {
            $table->id();

            // -- to identify which stock transfer item this detail belongs to
            $table->unsignedBigInteger('stock_transfer_item_id');
            $table->foreign('stock_transfer_item_id')
                ->references('id')->on('stock_transfer_items')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- to identify which stock record (batch_stocks.id or imei_serial_stocks.id)
            $table->unsignedBigInteger('stock_id');
            $table->enum('stock_type', ['batch', 'imei_serial']);

            $table->integer('quantity')->nullable(); // Only for batch tracking
            $table->string('imei_serial_number', 50)->nullable(); // Only for serial items

            // indexes for faster queries
            $table->index('stock_transfer_item_id');
            $table->index('stock_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfer_item_details');
    }
};
