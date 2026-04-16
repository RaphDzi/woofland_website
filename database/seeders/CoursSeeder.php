<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CoursSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('animer')->truncate();
        DB::table('cours')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $types = ['Obéissance', 'Agility', 'Chiot', 'Socialisation', 'Éducation avancée'];
        $terrains = ['Terrain A', 'Terrain B', 'Terrain C'];
        $heures = ['09:00:00', '10:30:00', '14:00:00', '15:30:00', '17:00:00'];
        $durees = [45, 60, 90];

        // =========================
        // 1. CREATE COURS FIRST
        // =========================
        $cours = [];

        for ($i = 1; $i <= 30; $i++) {

            $date = Carbon::now()->addDays(rand(1, 30));
            $heure_debut = $heures[array_rand($heures)];
            $duree = $durees[array_rand($durees)];

            $heure_fin = Carbon::parse($heure_debut)
                ->addMinutes($duree)
                ->format('H:i:s');

            $cours[] = [
                'date' => $date->toDateString(),
                'heure_debut' => $heure_debut,
                'heure_fin' => $heure_fin,
                'duree' => $duree,
                'type_cours' => $types[array_rand($types)],
                'terrain' => $terrains[array_rand($terrains)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // INSERT + récup IDs
        DB::table('cours')->insert($cours);

        $coursIds = DB::table('cours')->pluck('id');

        $users = DB::table('users')
            ->where('role', 'admin')
            ->pluck('id');

        // =========================
        // 2. CREATE ANIMER
        // =========================
        $animer = [];

        foreach ($coursIds as $coursId) {
            $animer[] = [
                'user_id' => $users->random(),
                'id_cours' => $coursId,
            ];
        }

        DB::table('animer')->insert($animer);
    }
}