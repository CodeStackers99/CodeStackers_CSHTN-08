<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Playlist;
use App\Models\Question;
use App\Models\Thought;
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

        //TESTIMONIAL MESSAGES
        $GLOBALS['testMessages'] = ["It is very easy to learn and if we have any query they provide us with a discussion forum.", "I just finished the course, still following the steps that webacquire is instructing, still need to learn a lot more :)", "I like the contents in average, test are very easy and contents are easy to learn and understand", "I started with the baiscs, completed frontend development course and gained so much knowledge through various instructors."];

        //USERS, QUESTIONS and ANSWERS
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

        //Updating 3 teachers aprroval_status.
        $approvedTeacher = User::where('role', 0)->inRandomOrder()->limit(3)->get();
        foreach ($approvedTeacher as $teacher) {
            $teacher->update([
                'approval_status' => 1
            ]);
        }

        //THOUGHTS
        $thoughts = ["Store windows are like landing pages on the website", "If You Think Math is Hard Try Web Design", "Copy and paste is a design error", "It’s harder to read code than to write it", "Code never lies; comments sometimes do.", "Ruby is rubbish! PHP is phpantastic!", "Java is to JavaScript what car is to Carpet.", "Design is not just what it looks like and feels like. Design is how it works", "Websites should look good from the inside and out", "Simplicity is the soul of efficiency", "Talk is cheap. Show me the code"];

        $GLOBALS['authors'] = ["Angela Ahrendts", "Pixxelznet", "Steve McConnell", "Joel Spolsky", "Ron Jeffries", "Nikita Popov", "Chris Heilmann", "Steve Jobs", "Paul Cookson", "Austin Freeman", "Linus Torvalds"];

        $i = 0;
        foreach($thoughts as $thought) {
            Thought::create([
                'name' => $GLOBALS['authors'][$i],
                'description' => $thought
            ]);
            $i++;
        };

        $this->call(CourseAndSubCourseSeeder::class);

        Playlist::factory(15)->create();
    }
}
