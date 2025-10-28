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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->date('order_date')->default(now());
            $table->decimal('price_total', 15, 2)->default(0);
            $table->decimal('dp_total', 15, 2)->default(0);
            $table->decimal('remaining_payment', 15, 2)->default(0);
            $table->date('paid_date')->nullable();
            $table->enum('status', [
                'diproses',
                'belum lunas',
                'selesai',
            ])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
