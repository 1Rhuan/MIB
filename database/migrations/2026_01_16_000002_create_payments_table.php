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
            $table->unsignedBigInteger('external_payment_id')->unique();
            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('external_reference')->nullable();
            $table->string('status');
            $table->string('status_detail');
            $table->decimal('transaction_amount', 10, 2);
            $table->decimal('fee_amount', 10, 2);
            $table->string('payment_method');
            $table->longText('qr_code_base64')->nullable();
            $table->text('qr_code')->nullable();
            $table->timestamp('date_created');
            $table->timestamp('date_approved')->nullable();
            $table->timestamp('date_expiration')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['external_reference', 'external_payment_id', 'order_id']);
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
