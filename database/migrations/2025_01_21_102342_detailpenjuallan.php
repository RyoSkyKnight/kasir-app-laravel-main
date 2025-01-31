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
        Schema::create('selling-detail', function (Blueprint $table) {
            $table->id();
            $table->string('selling_id')->constrained('selling');
            $table->foreignId('product_id')->constrained('product');
            $table->integer('quantity');
            $table->decimal('total_price', 65,2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling-detail');
    }
};
