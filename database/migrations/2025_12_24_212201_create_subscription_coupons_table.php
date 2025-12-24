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
        Schema::create('subscription_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('role', ['customer', 'mitra']);
            $table->integer('discount')->default(0);
            $table->boolean('is_lifetime')->default(false);
            $table->integer('max_usage')->nullable();
            $table->integer('used_count')->default(0);
            $table->date('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_coupons');
    }
};
