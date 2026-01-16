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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->ulid('reference')->unique();

            $table->foreignId('order_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->decimal('amount', 10, 2);
            $table->decimal('fee', 10, 2)->nullable();
            $table->decimal('net_amount', 10, 2)->nullable();

            $table->enum('payment_method', ['credit_card', 'debit_card', 'pix', 'boleto']);
            $table->enum('status', ['pending', 'approved', 'cancelled', 'failed']);

            $table->string('provider')->default('MercadoPago');
            $table->string('provider_id', 100);
            $table->string('provider_preference_id', 100)->nullable();
            $table->enum('provider_status', ['approved', 'rejected', 'pending', 'in_process']);

            $table->timestamp('expires_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('refunded_at')->nullable();

            $table->json('provider_payload')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
