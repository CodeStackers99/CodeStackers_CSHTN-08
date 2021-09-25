<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\TeacherApproved;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $users = User::where('role', User::USER_TEACHER)->latest()->get();
            return view('layouts.Admin.index', compact(['users']));
        }
    }

    public function status(User $user)
    {
        if (!($user->approval_status)) {
            $user->notify(new TeacherApproved($user));
        }
        $user->update(['approval_status' => !($user->approval_status)]);
        session()->flash('success', "Teacher $user->name is approved successfully. Mail sent successfully!");
        return redirect(route('user.teachers'));
    }
}
