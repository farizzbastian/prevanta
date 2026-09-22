<?php

namespace Tests\Feature;

use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\Pengukuran;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class DashboardPageTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_public_pages_render(): void
    {
        $this->get(route('landing'))->assertOk();
        $this->get(route('login'))->assertOk();
        $this->get(route('register'))->assertOk();
    }

    public function test_bidan_dashboard_and_portal_render_database_data(): void
    {
        $bidan = User::factory()->bidan()->create(['name' => 'Bidan Dewi']);
        $measurement = Pengukuran::factory()->create();

        $this->actingAs($bidan)
            ->get(route('bidan.dashboard'))
            ->assertOk()
            ->assertSeeText('Bidan Dewi');

        $this->actingAs($bidan)
            ->get(route('bidan.portal'))
            ->assertOk()
            ->assertSeeText($measurement->balita->nama)
            ->assertSeeText('Antrean & Riwayat Verifikasi Terkini');
    }

    public function test_parent_and_kader_main_pages_render(): void
    {
        $parentUser = User::factory()->orangTua()->create();
        OrangTua::factory()->for($parentUser)->create();
        $kader = User::factory()->kader()->create();

        $this->actingAs($parentUser)->get(route('parent.children'))->assertOk();
        $this->actingAs($kader)->get(route('kader.dashboard'))->assertOk();
    }

    public function test_all_protected_get_pages_render_for_the_correct_role(): void
    {
        $parentUser = User::factory()->orangTua()->create();
        $parent = OrangTua::factory()->for($parentUser)->create();
        $child = Balita::factory()->for($parent, 'orangTua')->create();
        $measurement = Pengukuran::factory()->for($child, 'balita')->create();
        $kader = User::factory()->kader()->create();
        $bidan = User::factory()->bidan()->create();

        foreach (['parent.children', 'parent.measurements', 'parent.immunizations', 'parent.education'] as $routeName) {
            $this->actingAs($parentUser)->get(route($routeName))->assertOk();
        }
        $this->actingAs($parentUser)->get(route('parent.child-profile', $child))->assertOk();

        foreach (['kader.dashboard', 'kader.monitoring', 'kader.add-child', 'kader.schedule', 'kader.education', 'kader.add-education'] as $routeName) {
            $this->actingAs($kader)->get(route($routeName))->assertOk();
        }
        $this->actingAs($kader)->get(route('kader.child-profile', $child))->assertOk();
        $this->actingAs($kader)->get(route('kader.measurement', $child))->assertOk();

        foreach (['bidan.dashboard', 'bidan.history', 'bidan.verification', 'bidan.portal'] as $routeName) {
            $this->actingAs($bidan)->get(route($routeName))->assertOk();
        }
        $this->actingAs($bidan)->get(route('bidan.verification', $measurement))->assertOk();
    }
}
