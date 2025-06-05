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
        Schema::create('outlet_bonus_targets', function (Blueprint $table) {
            $table->id();

            $table->string('target_name', 255);

            // -- to identify which item this bonus target is for
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('target_quantity');
            $table->double('amount_per_unit');
            $table->integer('achieved_quantity')->default(0);
            $table->date('from_date');
            $table->date('to_date');

            // -- to identify which outlet main target this bonus target belongs to
            $table->unsignedBigInteger('outlet_main_target_id');
            $table->foreign('outlet_main_target_id')
                ->references('id')->on('outlet_main_targets')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- to identify which outlet target this bonus target belongs to
            $table->unsignedBigInteger('outlet_target_id');
            $table->foreign('outlet_target_id')
                ->references('id')->on('outlet_targets')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->enum('completion_status', ['completed', 'pending']);

            // indexes for faster querying
            $table->index('item_id');
            $table->index('outlet_main_target_id');
            $table->index('outlet_target_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlet_bonus_targets');
    }
};
