<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Publication;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Publication::factory()->count(15)->create([
            'user_id' => $user->id,
        ]);
    }
}