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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            
            $table->string('business_name');
            
            // ['mobil', 'motor'] disimpan sebagai JSON
            $table->json('vehicle_type');
            
            $table->string('province');
            $table->string('regency');
            $table->string('address');
            
            // Koordinat (nullable)
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            
            // Status aktifasi mitra
            $table->boolean('is_active')->default(false);

            // Relasi user pembuat (creator)
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};
