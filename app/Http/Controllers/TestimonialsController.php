<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{

    public function index()
    {
        return redirect(route('testimonials.create'));
    }


    public function create()
    {
        if (!$this->canRate()) {
            return redirect(route('home'));
        }

        return view('layouts.Testimonial.create');
    }


    public function store(Request $request)
    {
        if (!$this->canRate()) {
            return redirect(route('home'));
        }
        $rules = [
            'description' => 'required|max:80',
            'ratings' => 'required|integer|between:1,5',
        ];

        $this->validate($request, $rules);

        auth()->user()->testimonial()->create([
            'description' => $request->description,
            'ratings' => (int)$request->ratings,
        ]);

        session()->flash('success', 'Thank You For Your Ratings. It Matters A Lot :)');
        return redirect(route('home'));
    }

    private function canRate()
    {
        if (auth()->user()->isTeacher() || auth()->user()->isAdmin()) {
            session()->flash('error', 'Only Students can rate the platform!');
            return false;
        }
        if (auth()->user()->testimonial()->exists()) {
            session()->flash('error', 'You have already rated!');
            return false;
        }

        return true;
    }
}
