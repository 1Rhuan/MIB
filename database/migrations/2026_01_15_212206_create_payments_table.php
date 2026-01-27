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
            $table->unsignedBigInteger('gateway_payment_id')->unique();
            $table->foreignId('order_id')->constrained();
            $table->string('status');
            $table->string('status_detail');
            $table->timestamp('date_created');
            $table->timestamp('date_last_updated');
            $table->timestamp('date_approved')->nullable();
            $table->timestamp('date_expiration')->nullable();
            $table->timestamp('money_release_date')->nullable();
            $table->decimal('transaction_amount', 10, 2);
            $table->decimal('transaction_amount_refunded', 10, 2)->default(0);
            $table->decimal('taxes_amount', 10, 2)->default(0);
            $table->decimal('net_received_amount', 10, 2)->default(0);
            $table->decimal('total_paid_amount', 10, 2)->default(0);
            $table->string('fee_type')->nullable();
            $table->decimal('fee_amount', 10, 2)->default(0);
            $table->string('currency_id', 3);
            $table->string('counter_currency')->nullable();
            $table->string('description')->nullable();
            $table->string('payment_method_id');
            $table->string('payment_type_id');
            $table->string('payment_method_reference_id')->nullable();
            $table->string('authorization_code')->nullable();
            $table->string('operation_type');
            $table->string('money_release_status')->nullable();
            $table->string('money_release_schema')->nullable();
            $table->unsignedBigInteger('issuer_id');
            $table->unsignedBigInteger('collector_id');
            $table->string('external_reference')->nullable();
            $table->string('external_resource_url')->nullable();
            $table->string('statement_descriptor')->nullable();
            $table->longText('qr_code_base64')->nullable();
            $table->text('qr_code')->nullable();
            $table->string('ticket_url')->nullable();
            $table->boolean('live_mode')->default(false);
            $table->timestamps();

            $table->index(['external_reference', 'gateway_payment_id', 'order_id']);
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
