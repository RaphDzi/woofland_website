<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('adhesions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->decimal('montant_cotisation', 8, 2)->nullable();

            $table->date('date_debut_abonnement')->nullable();
            $table->date('date_fin_abonnement')->nullable();

            $table->timestamp('date_derniere_mise_a_jour')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adhesions');
    }
};