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
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
        Schema::table('event_contact', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
        });

        // evaluator evaluation
        Schema::table('evaluator_evaluation', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
        });

        // pivot tables
        Schema::table('project_task', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
        });

        // project ponderation
        Schema::table('project_ponderation', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
        });

        // global comments tables
        Schema::table('evaluator_global_comment', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
        });

        Schema::table('event_global_comment', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('event_contact', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['contact_id']);
        });

        // evaluator evaluation
        Schema::table('evaluator_evaluation', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['event_contact_id']);
        });

        // pivot tables
        Schema::table('project_task', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['task_id']);
        });

        // project ponderation
        Schema::table('project_ponderation', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['project_id']);
        });

        // global comments tables
        Schema::table('evaluator_global_comment', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['contact_id']);
        });

        Schema::table('event_global_comment', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['contact_id']);
        });
    }
};
