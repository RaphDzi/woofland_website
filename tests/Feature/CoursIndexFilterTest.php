<?php

namespace Tests\Feature;

use App\Models\Cours;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoursIndexFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_cours_index_filters_by_type_terrain_and_date(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $matchingCourse = $this->createCourse([
            'date' => now()->addDays(2)->toDateString(),
            'type_cours' => 'Agility',
            'terrain' => 'Terrain A',
        ]);

        $this->createCourse([
            'date' => now()->addDays(3)->toDateString(),
            'type_cours' => 'Education',
            'terrain' => 'Terrain B',
        ]);

        $response = $this->actingAs($user)->get('/cours?' . http_build_query([
            'type_cours' => 'Agility',
            'terrain' => 'Terrain A',
            'date' => $matchingCourse->date,
        ]));

        $response->assertOk();
        $response->assertViewHas('cours', function ($cours) use ($matchingCourse) {
            return $cours->pluck('id')->all() === [$matchingCourse->id];
        });
    }

    public function test_cours_index_only_lists_upcoming_courses(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $upcomingCourse = $this->createCourse([
            'date' => now()->addDay()->toDateString(),
            'type_cours' => 'Education',
            'terrain' => 'Terrain A',
        ]);

        $this->createCourse([
            'date' => now()->subDay()->toDateString(),
            'type_cours' => 'Agility',
            'terrain' => 'Terrain B',
        ]);

        $response = $this->actingAs($user)->get('/cours');

        $response->assertOk();
        $response->assertViewHas('cours', function ($cours) use ($upcomingCourse) {
            return $cours->pluck('id')->all() === [$upcomingCourse->id];
        });
    }

    private function createCourse(array $overrides = []): Cours
    {
        return Cours::create(array_merge([
            'date' => now()->addDay()->toDateString(),
            'heure_debut' => '10:00:00',
            'heure_fin' => '11:00:00',
            'duree' => 60,
            'type_cours' => 'Education',
            'terrain' => 'Terrain A',
        ], $overrides));
    }
}
