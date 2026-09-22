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
        Schema::create('pengukuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balita_id')->constrained('balita')->cascadeOnDelete();
            $table->foreignId('kader_id')->constrained('users')->restrictOnDelete();
            $table->date('tanggal_pengukuran');
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('lingkar_lengan_atas', 5, 2)->nullable();
            $table->decimal('lingkar_kepala', 5, 2)->nullable();
            $table->string('foto')->nullable();
            $table->decimal('z_score', 4, 2)->nullable();
            $table->string('status_pertumbuhan', 30);
            $table->timestamps();

            $table->unique(['balita_id', 'tanggal_pengukuran']);
            $table->index(['status_pertumbuhan', 'tanggal_pengukuran']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengukuran');
    }
};
