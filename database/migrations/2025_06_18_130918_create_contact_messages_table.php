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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->string('ip_address')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        Schema::create('contact_message_replies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('contact_message_id');
            $table->text('message');
            $table->timestamps();

            $table->foreign('contact_message_id')
                ->references('id')->on('contact_messages')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_message_replies');
        Schema::dropIfExists('contact_messages');
    }
};
