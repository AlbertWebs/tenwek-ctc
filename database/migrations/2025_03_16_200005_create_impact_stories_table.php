<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impact_stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('story')->nullable();
            $table->string('image')->nullable();
            $table->date('story_date')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_stories');
    }
};
