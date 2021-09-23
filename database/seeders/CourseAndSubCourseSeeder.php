<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseAndSubCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('role', 1)->get()->first();
        $frontendCourse = Course::create([
            'name' => 'Frontend Development',
            'image' => 'images/courses/frontend-development.jpg',
            'description' => 'Front-end web development, also known as client-side development is the practice of producing HTML, CSS and JavaScript for a website or Web Application so that a user can see and interact with them directly. The challenge associated with front end development is that the tools and techniques used to create the front end of a website change constantly and so the developer needs to constantly be aware of how the field is developing.',
            'user_id' => $admin->id
        ]);

        $backendCourse = Course::create([
            'name' => 'Backend Development',
            'image' => 'images/courses/backend-development.jpg',
            'description' => 'Backend Development is also known as server-side development. It is everything that the users don’t see and contains behind-the-scenes activities that occur when performing any action on a website. Code written by backend developers helps browsers in communicating with the databases and store data into the database, read data from the database, update the data and delete the data or information from the database.',
            'user_id' => $admin->id
        ]);

    }
}
