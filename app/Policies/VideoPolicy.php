<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Video $video)
    {
        //
    }

    public function create(User $user)
    {
        return ($user->isTeacher() || $user->isAdmin());
    }

    public function update(User $user, Video $video)
    {
        return (($user->isTeacher() || $user->isAdmin()) && $user->id === $video->playlist->user_id);
    }

    public function delete(User $user, Video $video)
    {
        return (($user->isTeacher() && $user->id === $video->playlist->user_id) || $user->isAdmin());
    }

    public function restore(User $user, Video $video)
    {
        //
    }

    public function forceDelete(User $user, Video $video)
    {
        //
    }
}
