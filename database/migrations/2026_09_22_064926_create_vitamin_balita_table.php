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
        Schema::create('vitamin_balita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balita_id')->constrained('balita')->cascadeOnDelete();
            $table->foreignId('jenis_vitamin_id')->constrained('jenis_vitamin')->restrictOnDelete();
            $table->foreignId('kader_id')->constrained('users')->restrictOnDelete();
            $table->date('tanggal_pemberian');
            $table->string('status', 30);
            $table->timestamps();

            $table->unique(['balita_id', 'jenis_vitamin_id', 'tanggal_pemberian']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vitamin_balita');
    }
};
