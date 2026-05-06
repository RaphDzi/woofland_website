<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_or_update_address(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch('/profile/address', [
            'voie' => '12 rue des Lilas',
            'ville' => 'Lyon',
            'code_postal' => '69001',
            'complement' => 'Batiment B',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'address-updated');

        $this->assertDatabaseHas('adresses', [
            'user_id' => $user->id,
            'voie' => '12 rue des Lilas',
            'ville' => 'Lyon',
            'code_postal' => '69001',
            'complement' => 'Batiment B',
        ]);
    }

    public function test_user_can_update_their_dog(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $dog = $user->chiens()->create([
            'nom' => 'Rex',
            'age' => 2,
            'race' => 'Labrador',
        ]);

        $response = $this->actingAs($user)->patch("/profile/dog/{$dog->id}", [
            'nom' => 'Milo',
            'age' => 4,
            'race' => 'Berger australien',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('chiens', [
            'id' => $dog->id,
            'user_id' => $user->id,
            'nom' => 'Milo',
            'age' => 4,
            'race' => 'Berger australien',
        ]);
    }

    public function test_user_cannot_update_another_users_dog(): void
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

        $response = $this->actingAs($otherUser)->patch("/profile/dog/{$dog->id}", [
            'nom' => 'Milo',
            'age' => 4,
            'race' => 'Berger australien',
        ]);

        $response->assertNotFound();

        $this->assertDatabaseHas('chiens', [
            'id' => $dog->id,
            'nom' => 'Rex',
            'age' => 2,
            'race' => 'Labrador',
        ]);
    }

    public function test_user_can_delete_their_dog(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $dog = $user->chiens()->create([
            'nom' => 'Rex',
            'age' => 2,
            'race' => 'Labrador',
        ]);

        $response = $this->actingAs($user)->delete("/profile/dog/{$dog->id}");

        $response->assertRedirect();

        $this->assertDatabaseMissing('chiens', [
            'id' => $dog->id,
        ]);
    }
}
