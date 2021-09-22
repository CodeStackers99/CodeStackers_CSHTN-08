<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::flushEventListeners();
        // Admin User
        User::create([
            'name' =>     "Sandeep Ahuja",
            'email' => "sandeepahuja@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('Sandeep@123'),
            'image' => 'images/users/admin.jpg',
            'verification_id' => 'images/verification_id/admin.jpg',
            'role' => 1,
            'approval_status' => 1,
            'remember_token' => Str::random(10),
        ]);

        // Teacher User
        User::create([
            'name' =>     "Prof. Jagdish Yadav",
            'email' => "jagdishyadav@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('Jagdish@123'),
            'image' => 'images/users/teacher.jpg',
            'verification_id' => 'images/verification_id/teacher.jpg',
            'role' => 0,
            'approval_status' => 1,
            'remember_token' => Str::random(10),
        ]);

        // Student User
        User::create([
            'name' =>     "Aniket Rawat",
            'email' => "aniketrawat@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('Aniket@123'),
            'image' => 'images/users/student.jpg',
            'verification_id' => 'images/verification_id/student.jpg',
            'role' => 2,
            'approval_status' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::factory(10)->create()->each(function (User $user) {
            if ($user->role) {
                $user->update([
                    'approval_status' => 1,
                    'branch' => rand(3, 6)
                ]);
            }
        });
    }
}
