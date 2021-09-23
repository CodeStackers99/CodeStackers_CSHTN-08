<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CreateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    public function index()
    {
        $courses = Course::with('owner')->search()->orderBy('name')->paginate(10);
        return view('layouts.Course.index', compact(['courses']));
    }

    public function create()
    {
        $this->authorize('create', Course::class);
        return view('layouts.Course.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Course::class);

        $rules = [
            'name' => 'required|max:40|unique:courses',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:512'
        ];
        $this->validate($request, $rules);

        if ($request->hasFile('image')) {
            $image = $request->image->store('images/courses');
        }

        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'user_id' => auth()->user()->id
        ]);
        session()->flash('success', 'Course Created Successfully!');
        return redirect(route('courses.index'));
    }

    public function show(Course $course)
    {
        return redirect(route('courses.subcourses.index', $course->slug));
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        return view('layouts.Course.edit', compact('course'));
    }

    public function update(Course $course, Request $request)
    {
        $this->authorize('update', $course);

        $rules = [
            'name' => 'required|max:40|unique:courses,name,' . $course->id,
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:512',
        ];

        $this->validate($request, $rules);

        if ($request->hasFile('image')) {
            $course->deleteImage();
            $image = $request->image->store('images/courses');
        } else {
            $image = $course->image;
        }

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);

        session()->flash('success', 'Course has been edited Successfully!');
        return redirect(route('courses.index'));
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        $course->deleteImage();
        $course->delete();

        return redirect(route('courses.index'));
    }
}
