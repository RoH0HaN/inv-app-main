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
        Schema::create('finance_details', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50); // eg: bank_of_baroda
            $table->string('display_name', 50); // eg: Bank Of Baroda
            $table->string('email', 50)->unique();
            $table->string('whatsapp_number', 12)->nullable();
            $table->string('mobile', 12)->nullable();

            // -- add a opening balance for every finance details
            $table->double('opening_balance');
            $table->enum('opening_balance_type', ['to_pay', 'to_receive']);

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
        Schema::dropIfExists('finance_details');
    }
};
