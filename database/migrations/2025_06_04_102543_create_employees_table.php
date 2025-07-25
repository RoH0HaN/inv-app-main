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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50)->unique();
            $table->string('mobile', 12)->unique();
            $table->string('whatsapp_number', 12)->nullable();
            $table->string('address', 100);

            // -- to identify the alloted outlet of the employee, foreign key to outlets table added
            $table->unsignedBigInteger('outlet_id');
            $table->foreign('outlet_id')
                ->references('id')->on('outlets')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- Indexes for faster querying
            $table->index('outlet_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
