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
        Schema::create('wall_versions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('version');
            $table->json('design_json');
            $table->timestamp('published_at');
            $table->timestamps();

            $table->foreignUuid('wall_id')->constrained('freedom_walls')->onDelete('cascade');
            $table->unique(['wall_id', 'version']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wall_versions');
    }
};
