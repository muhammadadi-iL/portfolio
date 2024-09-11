<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_name' => 'Admin-panel',
            'name' => 'Admin',
            'email' => 'admin@mak-portfolio.com',
            'role_id' => 1,
            'password' => hash::make('admin!@#')
        ]);
    }
}
