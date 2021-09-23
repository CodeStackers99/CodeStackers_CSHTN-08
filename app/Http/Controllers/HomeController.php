<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Thought;
use App\Models\Video;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('owner')->where('ratings', 3)->orWhere('ratings', 4)->orWhere('ratings', 5)->get();
        return view('index', compact(['testimonials']));
    }

    public function dashboard()
    {
        $recentlyViewedVideo = auth()
            ->user()
            ->videos()
            ->latest('pivot_updated_at')
            ->where('is_watch_later', 0)
            ->limit(10)
            ->get();

        $topPlaylists = Video::orderBy('likes_count', 'DESC')
            ->with('playlist')
            ->get()
            ->pluck('playlist')
            ->unique();

        $watchLaterVideos = auth()
            ->user()
            ->videos()
            ->where('is_watch_later', 1)
            ->get();

        $courses = Course::all();

        $thought = Thought::inRandomOrder()->first();

        $enrolledInComplete = auth()->user()->enrolledPlaylist()->where('is_completed', 0)->whereBetween('completion_deadline', [now(), Carbon::today()->addDays(7)])->get();

        $enrollAnalysis['total'] = auth()->user()->enrolledPlaylist()->count();
        $enrollAnalysis['completed'] = auth()->user()->enrolledPlaylist()->where('is_completed', 1)->count();
        $enrollAnalysis['in_complete'] = auth()->user()->enrolledPlaylist()->where('is_completed', 0)->where('completion_deadline', '<=', now())->count();
        $enrollAnalysis['can_complete'] = $enrollAnalysis['total'] - $enrollAnalysis['completed'] - $enrollAnalysis['in_complete'];

        return view('layouts.dashboard', compact(['recentlyViewedVideo', 'topPlaylists', 'watchLaterVideos', 'courses', 'thought', 'enrollAnalysis', 'enrolledInComplete']));
    }
}
