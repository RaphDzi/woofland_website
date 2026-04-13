<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formateur;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FormateurSeeder extends Seeder
{
    public function run(): void
    {
        // 👤 créer un user admin
        $user = User::firstOrCreate([
            'email' => 'admin@woofland.fr',
        ], [
            'name' => 'Admin Woofland',
            'password' => Hash::make('password'),
        ]);

        // 🧑‍🏫 créer formateur lié
        Formateur::firstOrCreate([
            'user_id' => $user->id,
        ], [
            'nom' => 'Admin',
            'prenom' => 'Woofland',
            'date_creation' => now(),
            'is_admin' => true,
        ]);
    }
}