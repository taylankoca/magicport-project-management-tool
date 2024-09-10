<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a user with specific credentials
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'), // Use Hash to securely store the password
            'role' => 'user', // Use Hash to securely store the password
        ]);

        // Create a user with specific credentials
        User::create([
            'name' => 'Admin Doe',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // Use Hash to securely store the password
            'role' => 'admin', // Use Hash to securely store the password
        ]);
    }
}
