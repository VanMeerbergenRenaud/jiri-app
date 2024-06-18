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
        Schema::table('event_project', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
        });
        // evaluation
        /*Schema::table('evaluations', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
        });
        // performances
        Schema::table('performances', function (Blueprint $table) {
            $table->foreignId('evaluation_id')->constrained()->onDelete('cascade');
        });
        // implementations
        Schema::table('implementations', function (Blueprint $table) {
            $table->foreignId('evaluation_id')->constrained()->onDelete('cascade');
        });*/
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
        Schema::table('event_project', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['project_id']);
        });
        /*// evaluation
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['contact_id']);
        });
        // performances
        Schema::table('performances', function (Blueprint $table) {
            $table->dropForeign(['evaluation_id']);
        });
        // implementations
        Schema::table('implementations', function (Blueprint $table) {
            $table->dropForeign(['evaluation_id']);
        });*/
    }
};
