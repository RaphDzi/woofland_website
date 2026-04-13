<?php

namespace Database\Seeders;

use App\Models\Formateur;
use App\Models\Publication;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        $formateur = Formateur::first();

        Publication::factory()->count(15)->create([
            'id_formateur' => $formateur->id,
        ]);
    }
}