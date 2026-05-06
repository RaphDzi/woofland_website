<?php

namespace Tests\Feature;

use App\Models\Cours;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoursRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_for_course_more_than_six_hours_away(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $course = $this->createCourse(now()->addHours(8));

        $response = $this->actingAs($user)->post("/cours/{$course->id}/inscription");

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Inscription OK');

        $this->assertDatabaseHas('inscriptions', [
            'id_user' => $user->id,
            'id_cours' => $course->id,
        ]);
    }

    public function test_user_cannot_register_less_than_six_hours_before_course(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $course = $this->createCourse(now()->addHours(5));

        $response = $this->actingAs($user)->post("/cours/{$course->id}/inscription");

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Moins de 6h avant le cours');

        $this->assertDatabaseMissing('inscriptions', [
            'id_user' => $user->id,
            'id_cours' => $course->id,
        ]);
    }

    public function test_user_can_unregister_more_than_six_hours_before_course(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $course = $this->createCourse(now()->addHours(8));

        $user->coursInscrits()->attach($course->id);

        $response = $this->actingAs($user)->delete("/cours/{$course->id}/desinscription");

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Désinscription OK');

        $this->assertDatabaseMissing('inscriptions', [
            'id_user' => $user->id,
            'id_cours' => $course->id,
        ]);
    }

    private function createCourse($startsAt): Cours
    {
        return Cours::create([
            'date' => $startsAt->toDateString(),
            'heure_debut' => $startsAt->format('H:i:s'),
            'heure_fin' => $startsAt->copy()->addHour()->format('H:i:s'),
            'duree' => 60,
            'type_cours' => 'Education',
            'terrain' => 'Terrain A',
        ]);
    }
}
