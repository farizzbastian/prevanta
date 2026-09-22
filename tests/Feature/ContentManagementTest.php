<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ContentManagementTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_kader_can_create_a_schedule(): void
    {
        $kader = User::factory()->kader()->create();

        $response = $this->actingAs($kader)->post(route('kader.schedules.store'), [
            'jenis_kegiatan' => 'Pelayanan Posyandu',
            'tanggal' => now()->addWeek()->toDateString(),
            'lokasi' => 'Balai RW 03',
            'keterangan' => 'Penimbangan rutin dan pemberian vitamin.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('jadwal', [
            'user_id' => $kader->id,
            'jenis_kegiatan' => 'Pelayanan Posyandu',
        ]);
    }

    public function test_kader_can_publish_education_content(): void
    {
        $kader = User::factory()->kader()->create();
        $content = str_repeat('Materi ini menjelaskan kebutuhan gizi seimbang untuk pertumbuhan balita. ', 2);

        $response = $this->actingAs($kader)->post(route('kader.education.store'), [
            'judul' => 'Panduan Gizi Seimbang untuk Balita',
            'kategori' => 'Gizi',
            'konten' => $content,
        ]);

        $response->assertRedirectToRoute('kader.education');
        $this->assertDatabaseHas('edukasi', [
            'user_id' => $kader->id,
            'judul' => 'Panduan Gizi Seimbang untuk Balita',
        ]);
    }
}
