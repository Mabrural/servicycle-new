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
        Schema::create('mitra_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')
                ->constrained('mitras')
                ->cascadeOnDelete();

            $table->string('image_path');

            $table->boolean('is_cover')->default(false);

            $table->unsignedInteger('sort_order')->default(0);

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra_images');
    }
};
