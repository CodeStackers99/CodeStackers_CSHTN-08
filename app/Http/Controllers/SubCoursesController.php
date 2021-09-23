<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SubCourse;
use Illuminate\Http\Request;

class SubCoursesController extends Controller
{
    public function index(Course $course)
    {
        $subcourses = $course->subcourses()->search()->orderBy('name')->paginate(10);
        return view('layouts.Subcourse.index', compact(['course', 'subcourses']));
    }

    public function create(Course $course)
    {
        $this->authorize('create', SubCourse::class);
        return view('layouts.SubCourse.create', compact(['course']));
    }

    public function store(Course $course, Request $request)
    {
        $this->authorize('create', SubCourse::class);
        $rules = [
            'name' => 'required|max:40|unique:sub_courses',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:512',
        ];
        $this->validate($request, $rules);
        if ($request->hasFile('image')) {
            $image = $request->image->store('images/subCourses');
        }
        $description = $request->description;
        $description = explode("<div>", $description)[1];
        $description = explode("</div>", $description)[0];
        $course->subCourses()->create([
            'name' => strtolower($request->name),
            'description' => $request->description,
            'user_id' => auth()->id(),
            'image' => $image,
        ]);
        $courseName = $course->name;
        session()->flash('success', "New SubCourse for $courseName is created. You can now add PLaylists!");
        return redirect(route('courses.subcourses.index', $course->slug));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function show(SubCourse $subCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCourse $subCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCourse $subCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCourse $subCourse)
    {
        //
    }
}
