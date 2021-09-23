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
        $course->subCourses()->create([
            'name' => strtolower($request->name),
            'description' => $request->description,
            'user_id' => auth()->id(),
            'image' => $image,
        ]);
        $courseName = $course->name;
        session()->flash('success', "New SubCourse for $courseName is created. You can now add playlists.");
        return redirect(route('courses.subcourses.index', $course->slug));
    }

    public function show(Course $course, SubCourse $subCourse)
    {
        return redirect(route('courses.subcourses.playlists.index', [$course->slug, $subCourse->slug]));
    }

    public function edit(Course $course, SubCourse $subCourse)
    {
        $this->authorize('update', $subCourse);
        return view('layouts.SubCourse.edit', compact(['course', 'subCourse']));
    }

    public function update(Course $course, Request $request, SubCourse $subCourse)
    {
        $this->authorize('update', $subCourse);
        $rules = [
            'name' => 'required|max:40|unique:sub_courses,name,' . $subCourse->id,
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:512',
        ];
        $this->validate($request, $rules);
        if ($request->hasFile('image')) {
            $subCourse->deleteImage();
            $image = $request->image->store('images/subCourses');
        } else {
            $image = $subCourse->image;
        }
        $subCourse->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
        ]);
        session()->flash('success', "Subcourse '$subCourse->name' has been uppdated successfully. You can keep adding playlists.");
        return redirect(route('courses.subcourses.index', $course->slug));
    }

    public function destroy(Course $course, SubCourse $subCourse)
    {
        $this->authorize('delete', $subCourse);
        if ($subCourse->playlists()->exists()) {
            session()->flash('error', "Cannot delete '$subCourse->name' SubCourse. It contains some playlists.");
            return redirect(route('courses.subcourses.index', $course->slug));
        }
        $subCourseName = $subCourse->name;
        $subCourse->deleteImage();
        $subCourse->delete();

        session()->flash('success', "'$subCourseName' subcourse has been deleted Successfully.");
        return redirect(route('courses.subcourses.index', $course->slug));
    }

}
