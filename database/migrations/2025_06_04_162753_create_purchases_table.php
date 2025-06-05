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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
        
            // -- to identify which supplier/vendor the items were bought from
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->onDelete('cascade')->onUpdate('cascade');
                
            // Invoice and tracking information
            $table->string('invoice_number', 50); // Supplier's invoice number
            $table->string('purchase_code', 50);  // Internal system tracking code
            
            // Purchase date
            $table->date('date');
            
            // Financial calculations
            $table->double('tcs_tds');      // TCS or TDS applied during purchase
            $table->double('discount');     // Invoice level discount
            $table->double('round_off');    // Rounding adjustment
            $table->double('grand_total');  // Final total payable after tax, discount, and round-off
            
            // -- to identify which warehouse the stock will be stored in
            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')
                ->references('id')->on('warehouses')
                ->onDelete('cascade')->onUpdate('cascade');

            // indexes for faster querying
            $table->index('supplier_id');
            $table->index('warehouse_id');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
