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
            $table->foreignId('user_id')->nullable()->constrained();

            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->double('total_amount');
            $table->enum('payment_status', ['paid', 'unpaid', 'refunded'])->default('unpaid');
            $table->string('payment_method')->default('COD');
            $table->string('shipping_address');
            $table->text('customer_notes')->nullable();
            $table->string('phone_number', 20);
            $table->string('fullname', 150);

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
