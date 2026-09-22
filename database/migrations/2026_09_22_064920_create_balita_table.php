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
        Schema::create('balita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orang_tua_id')->constrained('orang_tua')->cascadeOnDelete();
            $table->string('nama', 100);
            $table->string('nik', 16)->unique();
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 20);
            $table->text('alamat');
            $table->timestamps();

            $table->index(['orang_tua_id', 'tanggal_lahir']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balita');
    }
};
