<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Course $course)
    {
    }


    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Course $course)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Course $course)
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Course $course)
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Course $course)
    {
        return $user->isAdmin();
    }
}
