<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PanitiaSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Panitia',
            'email' => 'panitia@qurban.com',
            'password' => Hash::make('panitia2025'),
        ]);
    }
}
