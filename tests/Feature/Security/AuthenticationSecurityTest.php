<?php

namespace Tests\Feature\Security;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_hashes_password(): void
    {
        $this->post('/register', $this->validRegistrationData([
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
        ]));

        $user = User::where('email', 'security@example.com')->firstOrFail();

        $this->assertNotSame('Password1!', $user->password);
        $this->assertTrue(Hash::check('Password1!', $user->password));
    }

    public function test_registration_rejects_weak_password(): void
    {
        $response = $this->post('/register', $this->validRegistrationData([
            'password' => 'password',
            'password_confirmation' => 'password',
        ]));

        $response->assertSessionHasErrors('password');

        $this->assertDatabaseMissing('users', [
            'email' => 'security@example.com',
        ]);
    }

    public function test_registration_rejects_duplicate_email(): void
    {
        User::factory()->create(['email' => 'security@example.com']);

        $response = $this->post('/register', $this->validRegistrationData());

        $response->assertSessionHasErrors('email');
    }

    public function test_registration_ignores_submitted_admin_role(): void
    {
        $this->post('/register', $this->validRegistrationData([
            'role' => 'admin',
        ]));

        $this->assertDatabaseHas('users', [
            'email' => 'security@example.com',
            'role' => 'membre',
        ]);
    }

    private function validRegistrationData(array $overrides = []): array
    {
        return array_merge([
            'username' => 'security_user',
            'firstname' => 'Sarah',
            'lastname' => 'Martin',
            'email' => 'security@example.com',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
            'phone' => '0600000000',
            'voie' => '12 rue des Lilas',
            'ville' => 'Lyon',
            'code_postal' => '69001',
            'complement' => null,
            'chiens' => [
                [
                    'nom' => 'Rex',
                    'age' => 3,
                    'race' => 'Labrador',
                ],
            ],
        ], $overrides);
    }
}
