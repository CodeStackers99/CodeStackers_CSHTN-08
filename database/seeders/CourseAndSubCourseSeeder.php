<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\SubCourse;
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

        $approvedTeacherId = User::where('role', 0)->where('approval_status', 1)->inRandomOrder()->pluck('id')->toArray();

        $randomImages = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg'];

        $html = SubCourse::create([
            'name' => 'html',
            'description' => 'HTML stands for hyper text markup language – it is used to display web pages on the browser. In order to create web pages, one should learn HTML.As its name suggests, HTML is a markup language, not a programming language. This means that we do not write programs using HTML; instead, markup language is mainly used to apply layout and formatting conventions to a text document. In other words, markup language makes text more interactive and dynamic.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $frontendCourse->id,
        ]);

        $css = SubCourse::create([
            'name' => 'css',
            'description' => 'CSS (Cascading Style Sheets) describes how HTML elements will be displayed on a webpage. It controls the design elements of a webpage such as color schemes, dimensions of the HTML elements, webpage layout, and variations in display for different devices and screen sizes.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $frontendCourse->id,
        ]);

        $js = SubCourse::create([
            'name' => 'javascript',
            'description' => 'JavaScript is a programming language that executes on the browser. It turns static HTML web pages into interactive web pages by dynamically updating content, validating form data, controlling multimedia, animate images, and almost everything else on the web pages.JavaScript is the third most important web technology after HTML and CSS. JavaScript can be used to create web and mobile applications, build web servers, create games, etc.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $frontendCourse->id,
        ]);

        $jquery = SubCourse::create([
            'name' => 'jquery',
            'description' => 'jQuery is one of the most popular JavaScript libraries out there. jQuery makes web development easier by overcoming all the “stuff” that makes JavaScript difficult to use. With jQuery, you can call simple methods instead rewriting task blocks.Any web developer should have jQuery under their belt.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $frontendCourse->id,
        ]);

        $reactJS = SubCourse::create([
            'name' => 'reactjs',
            'description' => 'React JS is an open-source JavaScript library for building user interfaces – usually for single-page and mobile applications.A user interface in React is built around components. Each of these components is a Javascript function defined by the user.      These components optionally accept inputs, i.e. props (properties), and return React elements that describe exactly how a section of the UI (user interface) should appear accordingly.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $frontendCourse->id,
        ]);

        $angular = SubCourse::create([
            'name' => 'angular',
            'description' => 'Angular is a framework that was developed by Google and is used to develop web and mobile web applications. It is used in the front-end development of an application. Angular developers to improve the responsiveness of an application – it is one of the leading frameworks that are used to develop SPA. Angular’s leading competitor is Facebook’s React framework.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $frontendCourse->id,
        ]);

        $vue = SubCourse::create([
            'name' => 'vuejs',
            'description' => 'Vue.js is a progressive, declarative JavaScript framework for building fast single-page applications. It is progressive because it can easily scale from a library to a full-featured framework.Vue offers an adoptable ecosystem that can scale between a library and a full-featured framework. It has become increasingly popular over the years, with 176k GitHub starsBased on the MVC architecture, Vue (pronounced “view”) is focused on the view layer only, and it provides a system that lets you declaratively make changes to the DOM. This means that you don’t have to worry about how your application’s UI is rendered or how changes are applied to the DOM.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $frontendCourse->id,
        ]);

        $php = SubCourse::create([
            'name' => 'php',
            'description' => 'PHP (previously referred to as Personal Home Page) is currently known as the Hypertext Preprocessor. It is a server-side, scripting language that is used for developing static and dynamic websites. PHP can also develop web applications.PHP is an open-source language and is free of cost.PHP is a server-side scripting language, it is executed on the server; hence, ​client machines do not need to have PHP installed.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $backendCourse->id,
        ]);

        $flask = SubCourse::create([
            'name' => 'flask',
            'description' => 'Flask is an API of Python that allows us to build up web-applications. It was developed by Armin Ronacher. Flask’s framework is more explicit than Django’s framework and is also easier to learn because it has less base code to implement a simple web-Application. A Web-Application Framework or Web Framework is the collection of modules and libraries that helps the developer to write applications without writing the low-level codes such as protocols, thread management, etc. Flask is based on WSGI(Web Server Gateway Interface) toolkit and Jinja2 template engine.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $backendCourse->id,
        ]);

        $django = SubCourse::create([
            'name' => 'django',
            'description' => 'Django is a high-level Python web framework that enables rapid development of secure and maintainable websites. Built by experienced developers, Django takes care of much of the hassle of web development, so you can focus on writing your app without needing to reinvent the wheel. It is free and open source, has a thriving and active community, great documentation, and many options for free and paid-for support.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $backendCourse->id,
        ]);

        $ruby = SubCourse::create([
            'name' => 'ruby',
            'description' => 'Ruby is a scripting language built from the ground up for use in front end and back end web development and similar applications. It is a robust, dynamically typed, and object-oriented language. What’s more, its syntax is so high-level and easy to understand that it’s considered as close as you can get to coding in English. Released in the 1990s, Ruby is an open-sourced language created by the Japanese programmer Yukihiro “Matz” Matsumoto. He has stated that the language is designed to be both fun and productive. Ruby is scripted, meaning that it’s an interpreted language rather than a compiled one. ',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $backendCourse->id,
        ]);

        $nodejs = SubCourse::create([
            'name' => 'nodejs',
            'description' => 'Node.js is an open-source, cross-platform, back-end JavaScript runtime environment that runs on the V8 engine and executes JavaScript code outside a web browser. Node.js lets developers use JavaScript to write command line tools and for server-side scripting—running scripts server-side to produce dynamic web page content before the page is sent to the user\'s web browser. Consequently, Node.js represents a "JavaScript everywhere" paradigm,[6] unifying web-application development around a single programming language, rather than different languages for server-side and client-side scripts.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $backendCourse->id,
        ]);

        $laravel = SubCourse::create([
            'name' => 'laravel',
            'description' => 'Laravel is a web application framework with expressive, elegant syntax. A web framework provides a structure and starting point for creating your application, allowing you to focus on creating something amazing while we sweat the details.Laravel strives to provide an amazing developer experience while providing powerful features such as thorough dependency injection, an expressive database abstraction layer, queues and scheduled jobs, unit and integration testing, and more.  Whether you are new to PHP or web frameworks or have years of experience, Laravel is a framework that can grow with you.',
            'user_id' => $approvedTeacherId[array_rand($approvedTeacherId)],
            'image' => 'images/subCourses/' . $randomImages[array_rand($randomImages)],
            'course_id' => $backendCourse->id,
        ]);
    }
}
