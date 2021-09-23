<?php

namespace App\Policies;

use App\Models\SubCourse;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubCoursePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, SubCourse $subCourse)
    {
        //
    }

    public function create(User $user)
    {
        return ($user->isTeacher() || $user->isAdmin());
    }

    public function update(User $user, SubCourse $subCourse)
    {
        return (($user->isTeacher() || $user->isAdmin()) && $user->id === $subCourse->user_id);
    }

    public function delete(User $user, SubCourse $subCourse)
    {
        return (($user->isTeacher() && $user->id === $subCourse->user_id) || $user->isAdmin());
    }

    public function restore(User $user, SubCourse $subCourse)
    {
        //
    }

    public function forceDelete(User $user, SubCourse $subCourse)
    {
        //
    }
}
