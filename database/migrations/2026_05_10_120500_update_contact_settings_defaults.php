<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $row = DB::table('contact_settings')->orderBy('id')->first();

        $data = [
            'address' => 'P.O Box 39, Bomet, Kenya, 036',
            'phone' => '+254 723 000036',
            'email' => 'ctc.info@tenwekhosp.org',
            'emergency_phone' => '+254 723 000036',
            'updated_at' => now(),
        ];

        if ($row) {
            DB::table('contact_settings')->where('id', $row->id)->update($data);
        } else {
            DB::table('contact_settings')->insert($data + ['created_at' => now()]);
        }
    }

    public function down(): void
    {
        // No-op: avoid overwriting user-managed contact settings.
    }
};

