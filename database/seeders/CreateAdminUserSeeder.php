<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Check if admin exists
        $admin = User::where('email', 'admin@motocross.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@motocross.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]);
            $this->command->info('Admin user created successfully!');
        } else {
            $this->command->info('Admin user already exists!');
        }

        // Create test customer if doesn't exist
        $customer = User::where('email', 'customer@test.com')->first();

        if (!$customer) {
            User::create([
                'name' => 'Test Customer',
                'email' => 'customer@test.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]);
            $this->command->info('Test customer created successfully!');
        }
    }
}
