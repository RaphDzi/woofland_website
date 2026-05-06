<?php

namespace Tests\Feature\Security;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AccessControlSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_authenticated_pages(): void
    {
        foreach (['/dashboard', '/profile', '/cours', '/messages'] as $uri) {
            $this->get($uri)->assertRedirect('/login');
        }
    }

    public function test_non_admin_cannot_access_admin_area(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => 'membre']);

        $this->actingAs($user)->get('/admin/dashboard')->assertForbidden();
        $this->actingAs($user)->get('/admin/users')->assertForbidden();
        $this->actingAs($user)->get('/admin/publications')->assertForbidden();
    }

    public function test_admin_cannot_change_their_own_role(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->patch("/admin/users/{$admin->id}/role", [
            'role' => 'membre',
        ]);

        $response->assertSessionHas('error', 'Tu ne peux pas modifier ton propre rôle.');

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'role' => 'admin',
        ]);
    }

    public function test_user_cannot_modify_another_users_dog(): void
    {
        /** @var User $owner */
        $owner = User::factory()->create();

        /** @var User $otherUser */
        $otherUser = User::factory()->create();
        $dog = $owner->chiens()->create([
            'nom' => 'Rex',
            'age' => 2,
            'race' => 'Labrador',
        ]);

        $this->actingAs($otherUser)
            ->patch("/profile/dog/{$dog->id}", [
                'nom' => 'Milo',
                'age' => 4,
                'race' => 'Berger australien',
            ])
            ->assertNotFound();

        $this->assertDatabaseHas('chiens', [
            'id' => $dog->id,
            'nom' => 'Rex',
        ]);
    }

    public function test_message_routes_require_authentication_middleware(): void
    {
        foreach (['messages.index', 'messages.show', 'messages.store', 'conversations.start'] as $routeName) {
            $route = Route::getRoutes()->getByName($routeName);

            $this->assertNotNull($route, "Route {$routeName} should exist.");
            $this->assertContains('auth', $route->gatherMiddleware());
        }
    }
}
