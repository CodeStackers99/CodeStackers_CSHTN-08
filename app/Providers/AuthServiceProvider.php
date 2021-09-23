<?php

namespace App\Providers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Playlist;
use App\Models\Question;
use App\Models\SubCourse;
use App\Models\Tag;
use App\Policies\AnswerPolicy;
use App\Policies\CoursePolicy;
use App\Policies\PlaylistPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\SubCoursePolicy;
use App\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

        Question::class => QuestionPolicy::class,
        Answer::class => AnswerPolicy::class,
        Course::class => CoursePolicy::class,
        SubCourse::class => SubCoursePolicy::class,
        Playlist::class => PlaylistPolicy::class,
        Tag::class => TagPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
