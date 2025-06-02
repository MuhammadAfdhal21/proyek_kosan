<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kosan;
use App\Models\PemilikKosan;

class KosanSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan sudah ada beberapa pemilik
        $pemilikList = PemilikKosan::all();

        if ($pemilikList->count() == 0) {
            $this->command->warn('Tidak ada data pemilik_kosan. Jalankan seeder PemilikKosanSeeder terlebih dahulu.');
            return;
        }

        foreach ($pemilikList as $pemilik) {
            // Buat 3 sampai 5 kosan per pemilik
            $jumlahKosan = 10;

            for ($i = 0; $i < $jumlahKosan; $i++) {
                Kosan::create([
                    'pemilik_kosan_id' => $pemilik->id,
                    'nama'             => 'Kost ' . fake()->company(),
                    'alamat'           => fake()->address(),
                    'fasilitas'        => 'WiFi, AC, Kamar Mandi Dalam, Parkir Motor',
                    'harga'            => fake()->randomFloat(2, 500000, 2000000),
                    'deskripsi'        => fake()->paragraph(3),
                ]);
            }
        }

        $this->command->info('Seeder Kosan berhasil menambahkan banyak data kosan untuk setiap pemilik.');
    }
}
