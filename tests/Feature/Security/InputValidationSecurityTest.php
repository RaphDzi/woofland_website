<?php

namespace Tests\Feature\Security;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class InputValidationSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_update_rejects_invalid_email(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch('/profile', [
            'firstname' => 'Sarah',
            'lastname' => 'Martin',
            'username' => 'sarah',
            'email' => 'not-an-email',
            'phone' => '0600000000',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'email' => 'not-an-email',
        ]);
    }

    public function test_admin_publication_rejects_non_image_upload(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/publications', [
            'title' => 'Document invalide',
            'description' => 'Cette publication tente de joindre un PDF.',
            'visibilite' => 'members_and_visitors',
            'image' => UploadedFile::fake()->create('document.pdf', 12, 'application/pdf'),
        ]);

        $response->assertSessionHasErrors('image');

        $this->assertDatabaseMissing('publications', [
            'titre' => 'Document invalide',
        ]);
    }
}
