<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin Roujwa',
            'email' => 'roujwa@pcr.ac.id',
            'password' => Hash::make('roujwa123')
        ]);

        // Create 100 dummy users menggunakan loop seperti contoh pelanggan
        $faker = \Faker\Factory::create();
        
        foreach (range(1, 100) as $index) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }

        $this->command->info('Successfully created 101 users (1 admin + 100 dummy users)!');
    }
}