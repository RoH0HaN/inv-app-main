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
        Schema::create('bank_account_access', function (Blueprint $table) {
            $table->id();

            // -- to identify for which bank account this access is related to, foreign key to bank account added
            $table->unsignedBigInteger('bank_account_id');
            $table->foreign('bank_account_id')
                ->references('id')->on('bank_accounts')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- their access permission is either given to warehouse or outlet
            $table->enum('location_type', ['warehouse', 'outlet']);
            $table->unsignedBigInteger('location_id');

            // -- indexes for faster querying
            $table->index('bank_account_id');
            $table->index('location_type');
            $table->index('location_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_account_access');
    }
};
