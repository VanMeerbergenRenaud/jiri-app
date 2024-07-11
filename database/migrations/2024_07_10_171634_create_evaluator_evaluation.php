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
        Schema::create('evaluator_evaluation', function (Blueprint $table) {
            $table->id();
            // score of the evaluation
            $table->decimal('score', 5, 2)->nullable();
            // comment of the evaluation
            $table->text('comment')->nullable();
            // status of the evaluation
            $table->enum('status', ['not evaluated', 'evaluated'])->default('not evaluated');
            // timer to see how long it took to evaluate
            $table->time('timer')->nullable();
            // cote public or not
            $table->boolean('public')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluator_evaluation');
    }
};
