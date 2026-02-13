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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->foreignId('id_membre')
                ->constrained('membres')
                ->onDelete('cascade');

            $table->foreignId('id_cours')
                ->constrained('cours')
                ->onDelete('cascade');

            $table->timestamp('date_inscription')->nullable();

            $table->unique(['id_membre', 'id_cours']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
