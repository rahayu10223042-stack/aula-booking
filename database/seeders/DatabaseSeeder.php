<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AulaSeeder::class,
            JenisSuratSeeder::class,
        ]);

        // akun admin default, GANTI PASSWORD-nya setelah login pertama kali
        User::firstOrCreate(
            ['email' => 'admin@bapelitbangda.go.id'],
            [
                'name' => 'Admin Bapelitbangda',
                'password' => bcrypt('password123'),
                'role' => 'admin',
            ]
        );
    }
}
