<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TwoFactorTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_verify_valid_two_factor_code(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'two_factor_code' => '123456',
            'two_factor_expires_at' => now()->addMinutes(10),
        ]);

        $response = $this
            ->withSession(['2fa:user:id' => $user->id])
            ->post('/2fa', ['code' => '123456']);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'two_factor_code' => null,
            'two_factor_expires_at' => null,
        ]);
    }

    public function test_user_can_remember_device_after_two_factor_verification(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'two_factor_code' => '123456',
            'two_factor_expires_at' => now()->addMinutes(10),
        ]);

        $response = $this
            ->withSession(['2fa:user:id' => $user->id])
            ->post('/2fa', [
                'code' => '123456',
                'remember' => '1',
            ]);

        $response->assertRedirect('/');
        $response->assertCookie('2fa_remember');

        $user->refresh();

        $this->assertNotNull($user->remember_2fa_token);
        $this->assertNotNull($user->remember_2fa_expires_at);
    }

    public function test_invalid_two_factor_code_returns_error(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'two_factor_code' => '123456',
            'two_factor_expires_at' => now()->addMinutes(10),
        ]);

        $response = $this
            ->withSession(['2fa:user:id' => $user->id])
            ->from('/2fa')
            ->post('/2fa', ['code' => '000000']);

        $response->assertRedirect('/2fa');
        $response->assertSessionHasErrors('code');
        $this->assertGuest();
    }

    public function test_two_factor_verification_redirects_to_login_without_session_user(): void
    {
        $response = $this->post('/2fa', ['code' => '123456']);

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
