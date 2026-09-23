<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('pengukuran')
            ->where('status_pertumbuhan', 'perlu_dipantau')
            ->update(['status_pertumbuhan' => 'pendek']);
        DB::table('pengukuran')
            ->where('status_pertumbuhan', 'risiko_stunting')
            ->update(['status_pertumbuhan' => 'sangat_pendek']);

        Schema::table('pengukuran', function (Blueprint $table) {
            $table->decimal('z_score', total: 5, places: 3)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('pengukuran')
            ->where('status_pertumbuhan', 'pendek')
            ->update(['status_pertumbuhan' => 'perlu_dipantau']);
        DB::table('pengukuran')
            ->where('status_pertumbuhan', 'sangat_pendek')
            ->update(['status_pertumbuhan' => 'risiko_stunting']);

        Schema::table('pengukuran', function (Blueprint $table) {
            $table->decimal('z_score', total: 4, places: 2)->nullable()->change();
        });
    }
};
