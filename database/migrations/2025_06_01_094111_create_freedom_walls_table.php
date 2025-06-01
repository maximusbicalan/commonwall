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
        Schema::create('freedom_walls', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('title', 200);
            $table->json('design_json');
            $table->json('tags')->nullable(); // store tags as JSON, add casting on model creation from 'tags' -> 'array'
            $table->boolean('is_public')->default(true);
            
            $table->unsignedInteger('version')->default(1);

            //foreign key to users table, constrained automatically determine table and column that's being referenced
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freedom_walls');
    }
};
