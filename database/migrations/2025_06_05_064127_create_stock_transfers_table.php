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
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();

            $table->enum('from_location_type', ['warehouse', 'outlet']);
            $table->unsignedBigInteger('from_location_id');
            $table->enum('to_location_type', ['warehouse', 'outlet']);
            $table->unsignedBigInteger('to_location_id');
            $table->string('transfer_code', 50);
            $table->string('transfer_request_code', 50);
            $table->timestamp('transfer_date');
            $table->enum('status', ['pending', 'in_transit', 'received', 'cancelled'])->default('pending');
            $table->string('note', 255)->nullable();

            // -- to identify who created this transfer
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- to identify who received this transfer
            $table->unsignedBigInteger('received_by_id')->nullable();
            $table->foreign('received_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');

            // indexes for faster querying
            $table->index('received_by_id');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfers');
    }
};
