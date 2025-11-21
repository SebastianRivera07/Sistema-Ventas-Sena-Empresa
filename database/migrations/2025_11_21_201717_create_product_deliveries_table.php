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
        Schema::create('product_deliveries', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('delivered_amount');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('provider_id')->constrained('providers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_deliveries');
    }
};
