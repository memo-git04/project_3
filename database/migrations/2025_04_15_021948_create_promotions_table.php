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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Unique code for the promotion
            $table->decimal('discount_amount', 8, 2); // Amount to be discounted
            $table->decimal('min_order_amount', 8, 2)->nullable(); // Minimum order amount to apply the promotion4
            $table->date('start_date'); // Start date of the promotion
            $table->date('end_date'); // End date of the promotion
            $table->boolean('is_used')->default(0); // 1: used, 0: not used
            $table->boolean('is_deleted')->default(0); // 1: deleted, 0: not deleted
            $table->integer('usage_limit');
            $table->integer('current_usage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
