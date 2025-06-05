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
        Schema::create('organization_additional_product_wise_targets', function (Blueprint $table) {
            $table->id();

            $table->integer('target_condition');
            $table->integer('target_bonus');

            // -- to identify which item this additional product-wise target is for
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->enum('target_condition_type', ['amount', 'quantity']);

            $table->enum('target_bonus_type', ['amount', 'percentage']);
            $table->integer('sold_quantity')->default(0);
            $table->double('sold_amount')->default(0);
            $table->double('total_payout')->default(0);
            $table->enum('completion_status', ['completed', 'pending']);

            // -- to identify which organization additional target this belongs to
            $table->unsignedBigInteger('add_tg_id');
            $table->foreign('add_tg_id')
                ->references('id')->on('organization_additional_targets')
                ->onUpdate('cascade')->onDelete('cascade');

            // -- to identify which organization target this belongs to
            $table->unsignedBigInteger('org_tg_id');
            $table->foreign('org_tg_id')
                ->references('id')->on('organization_targets')
                ->onUpdate('cascade')->onDelete('cascade');


            // indexes for faster queries
            $table->index('add_tg_id'); 
            $table->index('org_tg_id');
            $table->index('item_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_additional_product_wise_targets');
    }
};
