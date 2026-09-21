<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardPageTest extends TestCase
{
    public function test_dashboard_page_renders_the_bidan_portal_content(): void
    {
        $response = $this->get(route('bidan.portal'));

        $response
            ->assertOk()
            ->assertViewIs('pages.dashboard')
            ->assertSeeText([
                'Selamat Datang, Bidan Dewi Anggraini!',
                'Tren Prevalensi Stunting Wilayah Pustu',
                'Distribusi Status Gizi',
                'Antrean & Riwayat Log Verifikasi Terkini',
            ]);
    }

    public function test_all_frontend_pages_render_without_a_backend(): void
    {
        $routes = [
            'landing',
            'login',
            'register',
            'parent.children',
            'parent.child-profile',
            'parent.measurements',
            'parent.immunizations',
            'parent.education',
            'kader.dashboard',
            'kader.monitoring',
            'kader.child-profile',
            'kader.add-child',
            'kader.measurement',
            'kader.schedule',
            'kader.education',
            'kader.add-education',
            'bidan.dashboard',
            'bidan.history',
            'bidan.verification',
            'bidan.portal',
        ];

        foreach ($routes as $routeName) {
            $this->get(route($routeName))->assertOk();
        }
    }
}
