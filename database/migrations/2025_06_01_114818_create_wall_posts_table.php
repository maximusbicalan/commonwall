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
        Schema::create('wall_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->foreignUuid('wall_id')
                ->constrained('freedom_walls')
                ->onDelete('cascade');
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignUuid('pen_id')->nullable()->constrained('pens')->onDelete('set null');

            $table->text('content');
            // position x and y coordinates for the post
            $table->float('position_x');
            $table->float('position_y');

            $table->index(['wall_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wall_posts');
    }
};
