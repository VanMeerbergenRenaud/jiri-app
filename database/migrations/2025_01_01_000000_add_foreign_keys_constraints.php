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
            $table->foreignId('user_id')->constrained();
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained();
            $table->foreignId('contact_id')->constrained();
        });
        Schema::table('duties', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained();
            $table->foreignId('project_id')->constrained();
        });
        Schema::table('implementations', function (Blueprint $table) {
            $table->foreignId('duty_id')->constrained();
            $table->foreignId('contact_id')->constrained();
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained();
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
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['contact_id']);
        });
        Schema::table('duties', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['project_id']);
        });
        Schema::table('implementations', function (Blueprint $table) {
            $table->dropForeign(['duty_id']);
            $table->dropForeign(['contact_id']);
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
        });
    }
};
