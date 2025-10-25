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
        Schema::create('file_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commit_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->string('status'); // e.g., 'added', 'modified', 'removed'
            $table->integer('additions')->default(0);
            $table->integer('deletions')->default(0);
            $table->integer('changes')->default(0); // additions + deletions
            $table->timestamps();

            // Index for faster lookups on commit and file path
            $table->index(['commit_id', 'file_path']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_changes');
    }
};
