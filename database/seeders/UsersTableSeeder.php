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
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);

        User::factory()->create([
            'name' => 'Admin 2',
            'email' => 'admin2@example.com',
            'password' => bcrypt('admin2'),
            'two_factor_enabled' => true,
        ]);
    }
}
