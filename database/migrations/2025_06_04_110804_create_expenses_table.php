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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->string('expense_code', 50)->unique();
            $table->string('reference_number', 50);
            $table->string('display_name', 30);
            $table->string('description', 255)->nullable();
            
            // -- to identify which employee created this expense
            $table->unsignedBigInteger('created_for_employee_id');
            $table->foreign('created_for_employee_id')
                ->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');

            // -- to identify for which employee this expense is created
            $table->unsignedBigInteger('approved_for_employee_id');
            $table->foreign('approved_for_employee_id')
                ->references('id')->on('employees')
                ->onDelete('cascade')->onUpdate('cascade');

            // -- to identify who created this document, foreign key to user table added
            $table->unsignedBigInteger('created_by_id'); 
            $table->foreign('created_by_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- Indexes for faster querying
            $table->index('created_for_employee_id');
            $table->index('approved_for_employee_id');
            $table->index('created_by_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
