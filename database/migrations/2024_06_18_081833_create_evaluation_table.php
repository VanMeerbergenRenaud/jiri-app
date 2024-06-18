<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluation', function (Blueprint $table) {
            $table->id();
            $table->decimal('score', 5, 2)->nullable();
            $table->text('comment')->nullable();
            // status of the evaluation
            $table->enum('status', ['not evaluated', 'evaluated'])->default('not evaluated');
            // timer to see how long it took to evaluate
            $table->time('evaluation_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation');
    }
};
