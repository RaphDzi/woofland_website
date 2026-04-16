<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // USERS
        // =========================
        User::insert([
            [
                'username' => 'jean123',
                'lastname' => 'Dupont',
                'firstname' => 'Jean',
                'email' => 'jean@test.com',
                'phone' => '0600000001',
                'password' => Hash::make('password'),
                'role' => 'membre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'admin',
                'lastname' => 'Admin',
                'firstname' => 'Woofland',
                'email' => 'admin@woofland.com',
                'phone' => '0600000000',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'raphdzi',
                'lastname' => 'Doizi',
                'firstname' => 'Raphael',
                'email' => 'doizi.raphael@gmail.com',
                'phone' => '0600000002',
                'password' => Hash::make('Jeunesheguey54!'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // COURS
        // =========================
        DB::table('cours')->insert([
            [
                'date' => now(),
                'heure_debut' => '10:00:00',
                'heure_fin' => '11:00:00',
                'duree' => 60,
                'type_cours' => 'Obéissance',
                'terrain' => 'Terrain A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // PUBLICATIONS
        // =========================
        DB::table('publications')->insert([
            [
                'titre' => 'Bienvenue chez Woofland 🐶',
                'contenu' => 'Premier article de l’association dédié à l’éducation canine positive.',
                'visibilite' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Méthodes positives',
                'contenu' => 'Apprendre avec douceur, patience et récompenses.',
                'visibilite' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // ADRESSES
        // =========================
        DB::table('adresses')->insert([
            [
                'user_id' => 1,
                'voie' => '10 rue des Chiens',
                'ville' => 'Auxerre',
                'code_postal' => '89000',
                'complement' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // CHIENS
        // =========================
        DB::table('chiens')->insert([
            [
                'user_id' => 1,
                'nom' => 'Rex',
                'age' => 3,
                'race' => 'Labrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nom' => 'Bella',
                'age' => 2,
                'race' => 'Border Collie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // =========================
        // INSCRIPTIONS
        // =========================
        DB::table('inscriptions')->insert([
            [
                'id_user' => 1,
                'id_cours' => 1,
                'date_inscription' => now(),
            ],
        ]);

        $this->call([
            CoursSeeder::class,
        ]);
    }
}