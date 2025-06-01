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
        Schema::create('user_pens', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('pen_id')->constrained('pens')->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->timestamps();

            $table->primary(['user_id', 'pen_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pens');
    }
};
