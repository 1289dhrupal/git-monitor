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
        Schema::create('git_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('git_provider_id')->constrained()->onDelete('cascade');
            $table->text('token'); // Encrypted in the database
            $table->text('scopes')->nullable(); // Permissions granted by the token
            $table->timestamp('expires_at')->nullable(); // For refresh logic
            $table->boolean('is_enabled')->default(true); // User can disable this token
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('git_tokens');
    }
};
