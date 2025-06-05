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
        Schema::create('expense_items', function (Blueprint $table) {
            $table->id();

            // -- to identify which expense entry this item belongs to
            $table->unsignedBigInteger('expense_id');
            $table->foreign('expense_id')
                ->references('id')->on('expenses')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('expense', 127);
            $table->integer('quantity')->default(1);
            $table->double('price');
            $table->double('sub_total'); // quantity * price

            // -- Indexes for fast querying
            $table->index('expense_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_items');
    }
};
