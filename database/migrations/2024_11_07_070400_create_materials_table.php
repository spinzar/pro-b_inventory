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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bulk_unit_id')->constrained('units');
            $table->foreignId('retail_unit_id')->constrained('units');
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('material_category_id')->constrained();
            $table->string('name')->unique();
            $table->string('bulk_barcode')->nullable();
            $table->string('retail_barcode')->nullable();
            $table->double('buy_price');
            $table->double('sell_price');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
