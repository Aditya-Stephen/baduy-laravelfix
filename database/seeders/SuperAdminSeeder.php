<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'lppmumn.baduy@gmail.com',
            'password' => Hash::make('Baduyofficial2025'), // Gunakan password yang kuat di produksi
            'role' => 'superadmin',
            'email_verified_at' => now(),
        ]);
    }
}