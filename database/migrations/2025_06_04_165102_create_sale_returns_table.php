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
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->id();

            // -- to identify for which sale this return is initiated for
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')
                ->references('id')->on('sales')
                ->onDelete('cascade');

            // -- to identify which customer this sale return is initiated for
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('return_date');

            $table->double('total_return_amount');
            $table->string('return_note', 255)->nullable();

            // -- to identify who created this document, foreign key to user table added
            $table->unsignedBigInteger('created_by_id'); 
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- indexes to improve query performance
            $table->index('sale_id');
            $table->index('customer_id');
            $table->index('created_by_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_returns');
    }
};
