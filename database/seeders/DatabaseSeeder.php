<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'staffadmin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'staffadmin',
        ]);

        User::create([
            'name' => 'staffkepsek',
            'email' => 'kepsek@gmail.com',
            'password' => bcrypt('kepsek123'),
            'role' => 'staffkepsek',
        ]);

        User::create([
            'name' => 'siswa',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('siswa'),
            'role' => 'siswa',
        ]);
    }
}
