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
        Schema::create('credit_infos', function (Blueprint $table) {
            $table->id();

            // -- to identify which customer this credit info belongs to, foreign key to customers table added, and set to null on delete
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('set null'); // When customer is deleted, set customer_id to null

            // -- to identify which supplier this credit info belongs to, foreign key to suppliers table added, and set to null on delete
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')
                  ->references('id')
                  ->on('suppliers')
                  ->onDelete('set null'); // When supplier is deleted, set supplier_id to null
            
            $table->double('opening_balance')->default(0);
            $table->enum('opening_balance_type', ['to_pay', 'to_receive']);
            $table->integer('credit_period');
            $table->double('credit_limit')->default(0);
            
            // -- Indexes for better performance
            $table->index('customer_id');
            $table->index('supplier_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_infos');
    }
};
