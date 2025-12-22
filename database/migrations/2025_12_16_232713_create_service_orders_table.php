<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();

            // UUID (public identifier / QR)
            $table->uuid('uuid')->unique();

            // RELATION
            $table->foreignId('mitra_id')
                ->constrained('mitras')
                ->cascadeOnDelete();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->nullOnDelete();

            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            // ORDER TYPE
            $table->enum('order_type', ['online', 'walk_in']);

            // MANUAL VEHICLE INPUT (for walk-in / non-registered vehicle)
            $table->string('vehicle_type_manual')->nullable();
            $table->string('vehicle_brand_manual')->nullable();
            $table->string('vehicle_model_manual')->nullable();
            $table->string('vehicle_plate_manual')->nullable();

            // CUSTOMER & SERVICE
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_complain')->nullable();
            $table->text('diagnosed_problem')->nullable();

            // COST
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('final_cost', 10, 2)->nullable();

            // QUEUE (NULL = belum masuk antrian)
            $table->integer('queue_number')->nullable();

            // STATUS (dipisah jelas booking vs antrian)
            $table->enum('status', [
                'pending',      // booking dibuat (online)
                'accepted',     // bengkel setuju
                'rejected',     // bengkel tolak
                'checked_in',   // user datang / scan QR
                'waiting',      // masuk antrian
                'in_progress',  // sedang diservis
                'done',         // servis selesai
                'picked_up',    // kendaraan diambil
                'no_show',      // tidak datang
                'cancelled'     // dibatalkan
            ])->default('pending');

            // CHECK-IN & QR
            $table->string('qr_token')->nullable()->unique();
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamp('check_in_deadline')->nullable();

            // SERVICE TIMELINE
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamp('picked_up_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
