<?php

namespace Tests\Feature;

use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ParentPortalTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_parent_can_view_their_own_child(): void
    {
        $parentUser = User::factory()->orangTua()->create();
        $parent = OrangTua::factory()->for($parentUser)->create();
        $child = Balita::factory()->for($parent, 'orangTua')->create(['nama' => 'Anak Saya']);

        $this->actingAs($parentUser)
            ->get(route('parent.child-profile', $child))
            ->assertOk()
            ->assertSeeText('Anak Saya');
    }

    public function test_parent_cannot_view_another_parents_child(): void
    {
        $parentUser = User::factory()->orangTua()->create();
        OrangTua::factory()->for($parentUser)->create();
        $otherChild = Balita::factory()->create();

        $this->actingAs($parentUser)
            ->get(route('parent.child-profile', $otherChild))
            ->assertNotFound();
    }

    public function test_parent_pages_are_restricted_by_role(): void
    {
        $kader = User::factory()->kader()->create();

        $this->actingAs($kader)->get(route('parent.children'))->assertForbidden();
    }
}
