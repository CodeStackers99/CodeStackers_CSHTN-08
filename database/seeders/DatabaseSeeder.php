<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
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

        $GLOBALS['testMessages'] = ["It is very easy to learn and if we have any query they provide us with a discussion forum.", "I just finished the course, still following the steps that webacquire is instructing, still need to learn a lot more :)", "I like the contents in average, test are very easy and contents are easy to learn and understand", "I started with the baiscs, completed frontend development course and gained so much knowledge through various instructors."];

        User::factory(10)->create()->each(function (User $user) {
            if ($user->role) {
                $user->update([
                    'approval_status' => 1,
                    'branch' => rand(3, 6)
                ]);
                $user->testimonial()->create([
                    'description' => $GLOBALS['testMessages'][rand(0, 3)],
                    'ratings' => rand(3, 5),
                ]);
            }
            $user->questions()
                ->saveMany(Question::factory(rand(4, 7))->make())
                ->each(function (Question $question) {
                    $question->answers()->saveMany(Answer::factory(rand(0, 6))->make());
                });
        });

        $approvedTeacher = User::where('role', 0)->inRandomOrder()->limit(3)->get();
        foreach ($approvedTeacher as $teacher) {
            $teacher->update([
                'approval_status' => 1
            ]);
        }
    }
}
