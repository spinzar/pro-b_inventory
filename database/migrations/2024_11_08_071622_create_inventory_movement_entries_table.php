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
        Schema::create('inventory_movement_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_movement_id')->constrained();
            $table->foreignId('material_id')->constrained();
            $table->float('bulk_in');
            $table->float('retail_in');
            $table->float('bulk_out');
            $table->float('retail_out');
            // $table->double('bulk_price_in');
            // $table->double('retail_price_in');
            // $table->double('bulk_price_out');
            // $table->double('retail_price_out');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movement_entries');
    }
};
