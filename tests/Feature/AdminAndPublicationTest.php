<?php

namespace Tests\Feature;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAndPublicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => 'membre']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertForbidden();
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertOk();
    }

    public function test_admin_can_update_another_users_role(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        /** @var User $member */
        $member = User::factory()->create(['role' => 'membre']);

        $response = $this->actingAs($admin)->patch("/admin/users/{$member->id}/role", [
            'role' => 'formateur',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Rôle mis à jour');

        $this->assertDatabaseHas('users', [
            'id' => $member->id,
            'role' => 'formateur',
        ]);
    }

    public function test_admin_cannot_update_their_own_role(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->patch("/admin/users/{$admin->id}/role", [
            'role' => 'membre',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Tu ne peux pas modifier ton propre rôle.');

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'role' => 'admin',
        ]);
    }

    public function test_admin_can_create_publication(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/publications', [
            'title' => 'Nouveau cours collectif',
            'description' => 'Les inscriptions sont ouvertes pour samedi.',
            'visibilite' => 'members_and_visitors',
        ]);

        $response->assertRedirect(route('admin.publications.index'));
        $response->assertSessionHas('success', 'Publication créée');

        $this->assertDatabaseHas('publications', [
            'titre' => 'Nouveau cours collectif',
            'contenu' => 'Les inscriptions sont ouvertes pour samedi.',
            'visibilite' => 'members_and_visitors',
            'user_id' => $admin->id,
        ]);
    }

    public function test_publication_detail_page_is_visible(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $publication = Publication::create([
            'titre' => 'Actualite club',
            'contenu' => 'Le club organise une rencontre.',
            'visibilite' => 'members_and_visitors',
            'user_id' => $user->id,
        ]);

        $response = $this->get("/publications/{$publication->id}");

        $response->assertOk();
        $response->assertSee('Actualite club');
    }
}
