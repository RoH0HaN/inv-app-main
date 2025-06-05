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
        Schema::create('organization_targets', function (Blueprint $table) {
            $table->id();

            // -- to identify which brand this target belongs to
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')
                ->references('id')->on('brands')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->integer('year');// Year of the target
            $table->integer('month'); // Month of the target
             
            // -- to identify who created this entry
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            // indexes for faster queries
            $table->index('brand_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_targets');
    }
};
