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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->enum('role', ['user', 'admin', 'viewer']);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('email', 50)->unique();
            $table->string('mobile', 12);
            $table->string('status', 10);

            // -- to identify users belongs to which outlet and warehouse
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('outlet_id')->nullable();

            $table->string('profile_picture', 100);
            $table->string('entity_name', 30)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
