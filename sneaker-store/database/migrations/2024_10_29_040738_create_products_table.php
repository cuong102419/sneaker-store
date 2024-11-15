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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();

            $table->string('name', 255);
            $table->text('description');
            $table->double('price');
            $table->string('image')->nullable();
            $table->enum('status', ['available', 'discontinued', 'out_of_stock'])->default('available');
            $table->integer('view')->default(0);
            $table->integer('sales_count')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
