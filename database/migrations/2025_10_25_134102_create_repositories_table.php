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
        Schema::create('repositories', function (Blueprint $table) {
            $table->id();
            // Unique ID from provider to prevent duplicates
            $table->string('provider_repo_id');
            $table->string('name');
            $table->string('full_name'); // e.g., 'laravel/laravel'
            $table->string('url');
            $table->text('description')->nullable();
            $table->timestamps();

            // Unique constraint to prevent duplicate repositories from the same provider
            $table->unique(['provider_repo_id', 'full_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositories');
    }
};
