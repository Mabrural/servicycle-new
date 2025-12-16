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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            // UUID
            $table->uuid('uuid')->unique();

            // RELATION
            $table->foreignId('mitra_id')->constrained('mitras')->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->nullOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            // ORDER TYPE
            $table->enum('order_type', ['online', 'walk_in']);

            // MANUAL VEHICLE INPUT
            $table->string('vehicle_type_manual')->nullable();
            $table->string('vehicle_brand_manual')->nullable();
            $table->string('vehicle_model_manual')->nullable();
            $table->string('vehicle_plate_manual');

            // CUSTOMER & SERVICE
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_complain')->nullable();
            $table->text('diagnosed_problem')->nullable();

            // COST
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('final_cost', 10, 2)->nullable();

            // QUEUE & STATUS
            $table->integer('queue_number')->nullable();
            $table->enum('status', [
                'waiting',
                'accepted',
                'rejected',
                'in_progress',
                'done',
                'picked_up'
            ])->default('waiting');

            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamp('picked_up_at')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
