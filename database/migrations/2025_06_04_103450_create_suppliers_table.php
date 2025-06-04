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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50)->unique();
            $table->string('mobile', 12)->unique();
            $table->string('whatsapp_number', 12);
            $table->string('address', 100);
            $table->string('tax_number', 50)->unique();
            $table->string('pan_number', 50)->unique();

            // -- to identify the warehouse of the supplier, foreign key to warehouses table added
            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')
                ->references('id')->on('warehouses')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- to identify who created this document, foreign key to user table added
            $table->unsignedBigInteger('created_by_id'); 
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');  
                
            // -- Indexes for faster querying
            $table->index('created_by_id');
            $table->index('warehouse_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
