<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('111111'),
        ]);

        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@example.com',
            'otp' => false,
            'verified_at' => now(),
            'password' => bcrypt('admin123'),
        ]);
    }
}
