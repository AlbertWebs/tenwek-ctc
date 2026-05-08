<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // Backfill slugs for existing records.
        $members = DB::table('team_members')->select('id', 'name', 'slug')->get();
        foreach ($members as $m) {
            if (!empty($m->slug)) {
                continue;
            }
            $base = Str::slug($m->name);
            $slug = $base ?: ('specialist-' . $m->id);
            $slug = $slug . '-' . $m->id; // guarantee uniqueness
            DB::table('team_members')->where('id', $m->id)->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};

