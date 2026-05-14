<?php

namespace Tests\Feature;

use App\Models\Cours;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardMetricsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_displays_resource_counts(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);
        $author = User::factory()->create();

        Cours::create([
            'date' => now()->addDay()->toDateString(),
            'heure_debut' => '10:00:00',
            'heure_fin' => '11:00:00',
            'duree' => 60,
            'type_cours' => 'Education',
            'terrain' => 'Terrain A',
        ]);

        Publication::create([
            'titre' => 'Vie du club',
            'contenu' => 'Une publication de test.',
            'visibilite' => 'members_and_visitors',
            'user_id' => $author->id,
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertOk();
        $response->assertViewHas('usersCount', 2);
        $response->assertViewHas('coursesCount', 1);
        $response->assertViewHas('publicationsCount', 1);
    }
}
