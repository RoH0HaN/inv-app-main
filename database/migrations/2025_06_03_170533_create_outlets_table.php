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
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();

            $table->string('organization_logo', 100);
            $table->string('organization_name', 50);
            $table->string('mobile', 12);
            $table->string('tax_number', 50); // for GST-IN Number
            $table->string('alternative_mobile', 12);
            $table->string('email', 50)->unique();
            $table->string('address', 255);

            // -- for GST Bills
            $table->string('invoice_prefix_gst', 30);
            $table->string('invoice_number_gst', 100);
            // -- for non GST Bills
            $table->string('invoice_prefix_ngst', 30);
            $table->string('invoice_number_ngst', 100);

            // -- to identify which warehouse this outlet belongs to, foreign key to warehouse table added
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')
                ->references('id')->on('warehouses')
                ->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('outlets');
    }
};
