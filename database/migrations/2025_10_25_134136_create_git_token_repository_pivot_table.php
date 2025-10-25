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
        Schema::create('git_token_repository', function (Blueprint $table) {
            // Use foreignId for Laravel 8+ conventions
            $table->foreignId('git_token_id')->constrained()->onDelete('cascade');
            $table->foreignId('repository_id')->constrained()->onDelete('cascade');

            // User-specific enable/disable for this repo
            $table->boolean('is_enabled')->default(true);

            // Tracks when this specific connection was used
            $table->timestamp('last_synced_at')->nullable();

            $table->timestamps();

            // Set the primary key for the pivot table
            $table->primary(['git_token_id', 'repository_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('git_token_repository');
    }
};
