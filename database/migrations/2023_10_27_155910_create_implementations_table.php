<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('implementations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('urls')->nullable();
            // NB : Liste de toutes les tâches, mais un étudiant ne les a pas spécialement toutes réalisées
            $table->json('tasks')->nullable();
            $table->json('scores')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('implementations');
    }
};
