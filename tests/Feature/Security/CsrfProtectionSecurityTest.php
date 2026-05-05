<?php

namespace Tests\Feature\Security;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CsrfProtectionSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_sensitive_forms_render_csrf_tokens(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->get('/login')
            ->assertOk()
            ->assertSee('name="_token"', false);

        $this->get('/register')
            ->assertOk()
            ->assertSee('name="_token"', false);

        $this->actingAs($admin)
            ->get('/admin/publications/create')
            ->assertOk()
            ->assertSee('name="_token"', false);
    }
}
