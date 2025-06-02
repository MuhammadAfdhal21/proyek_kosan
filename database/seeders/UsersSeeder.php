<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Afdhal',
            'email' => 'afdhal1@gmail.com',
            'password'=> Hash::make('password'),
            'role' => 'penyewa'
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password'=> Hash::make ('1234567890') ,
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Pemilik Kost',
            'email' => 'kost@gmail.com',
            'password'=> Hash::make('password'),
            'role' => 'pemilik'
        ]);
    }
}
