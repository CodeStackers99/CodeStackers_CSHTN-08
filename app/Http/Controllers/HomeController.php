<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('owner')->where('ratings', 3)->orWhere('ratings', 4)->orWhere('ratings', 5)->get();
        return view('index', compact(['testimonials']));
    }
}
