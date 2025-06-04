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
        Schema::create('purchase_return_items', function (Blueprint $table) {
            $table->id();
            
            // -- Link to the parent purchase return
            $table->unsignedBigInteger('purchase_return_id')->nullable();
            $table->foreign('purchase_return_id')
                ->references('id')->on('purchase_returns')
                ->onDelete('cascade')->onUpdate('cascade');

            // -- Item being purchased
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->enum('return_type',['batch', 'imei_serial']);

            $table->integer('quantity');

            $table->string('return_reason', 100);

            // indexes for faster querying
            $table->index('purchase_return_id');
            $table->index('item_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_return_items');
    }
};
