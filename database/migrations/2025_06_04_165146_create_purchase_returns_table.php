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
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();
  
            // -- Supplier to whom the items are being returned
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // -- Link to the original purchase (optional, if partial return)
            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->foreign('purchase_id')
                ->references('id')->on('purchases')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // Return identification and date
            $table->string('return_number', 50);  // Return reference number (auto/manual)
            $table->date('return_date');          // Date when the return is made
            
            // Financial details
            $table->double('total_return_amount'); // Total return amount
            
            // Return information
            $table->string('return_note',255)->nullable(); // Notes or remarks about the return
            
            // -- Warehouse where stock is returned from
            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')
                ->references('id')->on('warehouses')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // -- User who created the return
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            // index
            $table->index('supplier_id');
            $table->index('purchase_id');
            $table->index('warehouse_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_returns');
    }
};
