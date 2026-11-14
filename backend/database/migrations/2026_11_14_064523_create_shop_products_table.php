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
        Schema::create('shop_products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
        $table->foreignId('product_id')->constrained()->restrictOnDelete();
        $table->decimal('cost_price', 12, 2)->default(0)->comment('What the shop paid');
        $table->decimal('retail_price', 12, 2)->default(0)->comment('Selling price set by the shop owner');
        $table->unsignedInteger('stock')->default(0)->comment('Shop stock');
        $table->unsignedInteger('low_stock_alert')->default(5)->comment('Warn when stock is at or below this');
        $table->timestamps();

        $table->unique(['shop_id', 'product_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_products');
    }
};
