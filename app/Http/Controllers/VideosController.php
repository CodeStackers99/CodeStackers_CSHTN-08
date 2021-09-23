<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Playlist;
use App\Models\SubCourse;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course, SubCourse $subCourse, Playlist $playlist)
    {
        if (!($this->checkCourseSubCourseAndPlaylist($course, $subCourse, $playlist))) {
            return redirect(route('courses.subcourses.index', $course->slug));
        }
        $videos = $playlist->videos()->with('tags')->search()->orderBy('id')->paginate(10);
        return view('layouts.Video.index', compact(['course', 'subCourse', 'playlist', 'videos']));
    }

    public function create(Course $course, SubCourse $subCourse, Playlist $playlist)
    {
        if (!($this->checkCourseSubCourseAndPlaylist($course, $subCourse, $playlist))) {
            return redirect(route('courses.subcourses.index', $course->slug));
        }
        $this->authorize('create', Video::class);
        $tags = Tag::all();

        return view('layouts.Video.create', compact(['course', 'subcourse', 'playlist', 'tags']));
    }

    public function store(Course $course, SubCourse $subCourse, Playlist $playlist, Request $request)
    {
        $this->authorize('create', Video::class);

        $rules = [
            'title' => 'required|max:60|unique:videos',
            'description' => 'required',
            'video' => 'required|video|mimes:mp4,mov,ogg,webm|max:50000',
            'tags' => 'required|exists:tags,id'
        ];
        $this->validate($request, $rules);
        if ($request->hasFile('video')) {
            $videoInput = $request->video->store('videos');
        }
        $description = $request->description;
        $description = explode("<div>", $description)[1];
        $description = explode("</div>", $description)[0];
        $video = $playlist->videos()->create([
            'title' => $request->title,
            'description' => $description,
            'video' => $videoInput,
        ]);
        $video->tags()->attach($request->tags);
        session()->flash('success', "New Video Has Been Added Successfully. Add More if any!");
        return redirect(route('courses.subcourses.playlists.videos.create', [$course, $subCourse, $playlist]));
    }

    public function show(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video)
    {
        //
    }

    public function edit(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video)
    {
        //
    }

    public function update(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video, Request $request)
    {
        //
    }

    public function destroy(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video)
    {
        //
    }

    private function checkCourseSubCourseAndPlaylist(Course $course, SubCourse $subCourse, Playlist $playlist)
    {
        if (!($subCourse->course->id === $course->id && $playlist->subcourse->id === $subCourse->id)) {
            session()->flash('error', "Something Fishy Please Select respective Subcourses and Its Playlists!");
            return false;
        }
        return true;
    }
}
