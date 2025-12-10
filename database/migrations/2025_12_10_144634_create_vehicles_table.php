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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            // FK ke customers
            $table->foreignId('customer_id')
                  ->constrained('customers')
                  ->onDelete('cascade');

            // atribut kendaraan
            $table->enum('vehicle_type', ['motor', 'mobil']);
            $table->string('brand');
            $table->string('model');
            $table->year('tahun');
            $table->string('plate_number')->unique();

            // opsional
            $table->integer('kilometer')->nullable();
            $table->date('masa_berlaku_stnk')->nullable();

            // created_by FK user
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
