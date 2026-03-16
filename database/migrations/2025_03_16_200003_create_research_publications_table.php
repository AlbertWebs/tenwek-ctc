<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('authors')->nullable();
            $table->string('journal')->nullable();
            $table->string('year', 4)->nullable();
            $table->string('url')->nullable();
            $table->text('abstract')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_publications');
    }
};
