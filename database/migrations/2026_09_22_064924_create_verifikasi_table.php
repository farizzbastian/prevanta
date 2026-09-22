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
        Schema::create('verifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengukuran_id')->unique()->constrained('pengukuran')->cascadeOnDelete();
            $table->foreignId('bidan_id')->constrained('users')->restrictOnDelete();
            $table->date('tanggal_verifikasi');
            $table->string('status', 30);
            $table->text('catatan_penyuluhan')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi');
    }
};
