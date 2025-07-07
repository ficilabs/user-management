<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            try {
                $admin = User::create([
                    'name'              => 'Administrator',
                    'username'          => 'administrator',
                    'email'             => 'administrator@gmail.com',
                    'email_verified_at' => now(),
                    'password'          => Hash::make('administrator'),
                ]);
                $admin->assignRole('Administrator');

                $user = User::create([
                    'name'              => 'Fici',
                    'username'          => 'fici',
                    'email'             => 'fici@gmail.com',
                    'email_verified_at' => now(),
                    'password'          => Hash::make('cotot977'),
                ]);
                $user->assignRole('Teacher');

                // Random Users (20)
                User::factory()
                    ->count(20)
                    ->create()
                    ->each(fn ($user) => $user->assignRole('Teacher'));

                // Random Users (100)
                User::factory()
                    ->count(100)
                    ->create()
                    ->each(fn ($user) => $user->assignRole('Student'));
            } catch (\Throwable $e) {
                throw $e;
            }
        });
    }
}