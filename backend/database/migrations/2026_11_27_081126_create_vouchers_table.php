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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('code')->unique();
            $table->enum('type', ['percent', 'fixed_amount']);
            $table->decimal('discount_value', 15, 2);
            $table->decimal('min_order_value', 15, 2)->default(0);
            $table->decimal('max_discount_value', 15, 2)->nullable();
            $table->integer('usage_limit')->default(0);
            $table->integer('used_count')->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['active', 'expired', 'disabled'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
