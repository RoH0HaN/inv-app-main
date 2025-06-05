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
        Schema::create('outlet_main_targets', function (Blueprint $table) {
            $table->id();

            $table->string('target_name', 255);
            $table->double('amount');
            $table->date('from_date');
            $table->date('to_date');
            // -- to identify which outlet target this main target belongs to
            $table->unsignedBigInteger('outlet_target_id');
            $table->foreign('outlet_target_id')
                ->references('id')->on('outlet_targets')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->enum('completion_status', ['completed', 'pending']);

            //indexes for faster querying
            $table->index('outlet_target_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlet_main_targets');
    }
};
