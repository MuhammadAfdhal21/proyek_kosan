<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PemilikKosan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemilik_kosans')->insert([
            [
                'user_id' => 1,
                'nama' => 'Muhammad Afdhal',
                'kontak' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
