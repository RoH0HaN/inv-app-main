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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            
            $table->string('invoice_number', 50);
            $table->string('sale_code', 50);
            $table->double('tcs_tds'); // eg: 0.18
            $table->double('round_off');
            $table->double('grand_total');
            
            // -- to identify which employee assisted the sale
            $table->unsignedBigInteger('sales_assistant');
            $table->foreign('sales_assistant')
                ->references('id')->on('employees')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- to identify which customer this sale is for
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- to identify which outlet initiated this sale
            $table->unsignedBigInteger('outlet_id');
            $table->foreign('outlet_id')
                ->references('id')->on('outlets')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- Indexes for faster queries
            $table->index('date');
            $table->index('invoice_number');
            $table->index('sales_assistant');
            $table->index('customer_id');
            $table->index('outlet_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
