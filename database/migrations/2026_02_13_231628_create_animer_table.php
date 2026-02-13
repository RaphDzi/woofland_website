<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animer', function (Blueprint $table) {
            $table->foreignId('id_formateur')
                ->constrained('formateurs')
                ->onDelete('cascade');

            $table->foreignId('id_cours')
                ->constrained('cours')
                ->onDelete('cascade');

            $table->unique(['id_formateur', 'id_cours']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animer');
    }
};
