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
        Schema::table('event_contact', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
        });
        Schema::table('event_project', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
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
        Schema::table('event_project', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['project_id']);
        });
    }
};
