<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('reference')->unique(); // dari Tripay
            $table->string('merchant_ref')->unique(); // internal invoice

            $table->string('payment_method')->nullable(); // BRIVA, QRIS, dll
            $table->integer('amount'); // harga final
            $table->integer('discount')->default(0);

            $table->enum('status', [
                'PENDING',
                'PAID',
                'FAILED',
                'EXPIRED'
            ])->default('PENDING');

            $table->string('checkout_url')->nullable();

            $table->json('payload')->nullable(); // simpan raw response Tripay
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_transactions');
    }
};
