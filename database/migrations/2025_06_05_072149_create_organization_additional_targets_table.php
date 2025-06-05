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
        Schema::create('organization_additional_targets', function (Blueprint $table) {
            $table->id();

            $table->string('target_name', 255);
            $table->date('from_date');
            $table->date('to_date');
            $table->double('achieved_value')->default(0);
            $table->enum('completion_status', ['completed', 'pending']);

            // -- to identify which organization target this additional target belongs to
            $table->unsignedBigInteger('organization_target_id');
            $table->foreign('organization_target_id')
                ->references('id')->on('organization_targets')
                ->onUpdate('cascade')->onDelete('cascade');
            
            // indexes for faster queries
            $table->index('organization_target_id');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_additional_targets');
    }
};
