<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class dogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_can_create_dog()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/profile/dog', [
            'nom' => 'Rex'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('chiens', [
            'nom' => 'Rex'
        ]);
    }
}
