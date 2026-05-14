<?php

namespace Tests\Feature;

use App\Models\Adhesion;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_profile_relationships_return_expected_models(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $address = $user->adresse()->create([
            'voie' => '12 rue des Lilas',
            'ville' => 'Lyon',
            'code_postal' => '69001',
            'complement' => null,
        ]);

        $dog = $user->chiens()->create([
            'nom' => 'Rex',
            'age' => 3,
            'race' => 'Labrador',
        ]);

        $adhesion = Adhesion::create([
            'user_id' => $user->id,
            'montant_cotisation' => 120,
            'date_debut_abonnement' => now(),
            'date_fin_abonnement' => now()->addYear(),
            'date_derniere_mise_a_jour' => now(),
        ]);

        $this->assertTrue($user->adresse->is($address));
        $this->assertTrue($user->chiens->first()->is($dog));
        $this->assertTrue($user->adhesion->is($adhesion));
        $this->assertTrue($adhesion->user->is($user));
    }

    public function test_publication_image_url_uses_default_image_when_empty(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $publication = Publication::create([
            'titre' => 'Actualite',
            'contenu' => 'Contenu de test',
            'visibilite' => 'members_and_visitors',
            'user_id' => $user->id,
            'image' => null,
        ]);

        $this->assertSame(asset('images/default.jpg'), $publication->image_url);
        $this->assertTrue($publication->user->is($user));
    }

    public function test_publication_image_url_uses_storage_path_when_image_exists(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $publication = Publication::create([
            'titre' => 'Actualite',
            'contenu' => 'Contenu de test',
            'visibilite' => 'members_and_visitors',
            'user_id' => $user->id,
            'image' => 'uploads/publications/photo.jpg',
        ]);

        $this->assertSame(
            asset('storage/uploads/publications/photo.jpg'),
            $publication->image_url
        );
    }
}
