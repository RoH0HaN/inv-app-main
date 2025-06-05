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
        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('particular', 50); // why this entry is created
            $table->string('voucher_type', 50); // for what entity this amount is for
            $table->string('voucher_number');

            // -- to identify at what location this amount is handled
            $table->enum('location_type', ['warehouse', 'outlet']);
            $table->unsignedBigInteger('location_id');

            $table->enum('transaction_type', ['in', 'out', 'adjustment']);

            $table->string('source_type', 50); // eg: 'sale', 'purchase', 'payment_in', 'payment_out', 'adjustment'
            $table->unsignedBigInteger('source_id'); // eg: sale_id, purchase_id
            $table->double('amount');
            $table->string('reason', 255)->nullable();

            // -- to identify which user created this entry, foreign key to user added
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            // -- indexes to optimize queries
            $table->index(['location_type', 'location_id']);
            $table->index(['source_type', 'source_id']);
            $table->index('created_by_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_transactions');
    }
};
