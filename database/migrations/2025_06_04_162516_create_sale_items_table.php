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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();

            // -- to identify which sale this item is belongs to
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')
                ->references('id')->on('sales')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- to identify which item this sale item is
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('quantity');
            $table->double('price');
            $table->double('discount'); // in percentage, eg: 5.5
            $table->double('tax'); // in percentage, eg: 5.5
            $table->double('total');

            $table->enum('tracking_type', ['imei_serial', 'batch']);

            // -- indexes for faster queries
            $table->index('sale_id');
            $table->index('item_id');
            $table->index('tracking_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
