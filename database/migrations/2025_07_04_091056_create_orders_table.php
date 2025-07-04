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
            $table->uuid('id')->primary();
            $table->string('external_id')->nullable()->index();
            $table->string('customer_name');
            $table->string('commodity');
            $table->string('sub_commodity');
            $table->integer('quantity');
            $table->string('unit');
            $table->dateTime('delivery_date');
            $table->timestamps();

            $table->unique(['external_id', 'delivery_date', 'customer_name'], 'order_unique');
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
