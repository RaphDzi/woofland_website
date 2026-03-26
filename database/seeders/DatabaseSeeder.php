<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // MEMBRES
        // =========================
        DB::table('membres')->insert([
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'mail' => 'jean@test.com',
                'username' => 'jean123',
                'mdp' => Hash::make('password'),
                'date_creation_compte' => now(),
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Claire',
                'mail' => 'claire@test.com',
                'username' => 'claire123',
                'mdp' => Hash::make('password'),
                'date_creation_compte' => now(),
            ],
        ]);

        // =========================
        // ADRESSES (1-1)
        // =========================
        DB::table('adresses')->insert([
            [
                'voie' => '10 rue des Lilas',
                'ville' => 'Paris',
                'code_postal' => '75000',
                'complement' => null,
                'id_membre' => 1,
            ],
            [
                'voie' => '5 avenue Victor Hugo',
                'ville' => 'Lyon',
                'code_postal' => '69000',
                'complement' => null,
                'id_membre' => 2,
            ],
        ]);

        // =========================
        // CHIENS
        // =========================
        DB::table('chiens')->insert([
            [
                'nom' => 'Rex',
                'age' => 3,
                'race' => 'Berger Allemand',
                'id_membre' => 1,
            ],
            [
                'nom' => 'Bella',
                'age' => 2,
                'race' => 'Labrador',
                'id_membre' => 2,
            ],
        ]);

        // =========================
        // FORMATEURS
        // =========================
        DB::table('formateurs')->insert([
            [
                'nom' => 'Durand',
                'prenom' => 'Paul',
                'mail' => 'paul@woofland.com',
                'username' => 'pauladmin',
                'mdp' => Hash::make('password'),
                'date_creation' => now(),
                'is_admin' => true,
            ],
            [
                'nom' => 'Bernard',
                'prenom' => 'Sophie',
                'mail' => 'sophie@woofland.com',
                'username' => 'sophieform',
                'mdp' => Hash::make('password'),
                'date_creation' => now(),
                'is_admin' => false,
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
            ],
        ]);

        // =========================
        // INSCRIPTIONS (pivot)
        // =========================
        DB::table('inscriptions')->insert([
            [
                'id_membre' => 1,
                'id_cours' => 1,
                'date_inscription' => now(),
            ],
        ]);

        // =========================
        // ANIMER (pivot)
        // =========================
        DB::table('animer')->insert([
            [
                'id_formateur' => 1,
                'id_cours' => 1,
            ],
            [
                'id_formateur' => 2,
                'id_cours' => 1,
            ],
        ]);

        // =========================
        // PUBLICATIONS
        // =========================
        DB::table('publications')->insert([
            [
                'date_publication' => now(),
                'titre' => 'Bienvenue chez Woofland',
                'contenu' => 'Premier article officiel de l\'association.',
                'visibilite' => 'public',
                'id_formateur' => 1,
            ],
        ]);
    }
}
