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
        Schema::create('units', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50); // eg: Box, Piece
            $table->string('code', 10); // eg: BOX, PCS
            $table->string('description', 100)->nullable(); 

            // -- to identify who created this document, foreign key to user table added
            $table->unsignedBigInteger('created_by_id'); 
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
