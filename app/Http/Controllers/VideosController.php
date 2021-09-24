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
        $courses = Course::all();
        return view('layouts.Video.index', compact(['course', 'subCourse', 'playlist', 'videos', 'courses']));
    }

    public function create(Course $course, SubCourse $subCourse, Playlist $playlist)
    {
        $this->authorize('create', Video::class);
        if (!($this->checkCourseSubCourseAndPlaylist($course, $subCourse, $playlist))) {
            return redirect(route('courses.subcourses.index', $course->slug));
        }
        $tags = Tag::all();

        return view('layouts.Video.create', compact(['course', 'subCourse', 'playlist', 'tags']));
    }

    public function store(Course $course, SubCourse $subCourse, Playlist $playlist, Request $request)
    {
        $this->authorize('create', Video::class);

        $rules = [
            'title' => 'required|max:60|unique:videos',
            'description' => 'required',
            'video' => 'required|file|mimes:mp4,mov,ogg,webm|max:50000',
            'display_image' => 'required|image|mimes:jpeg,jpg,png|max:1000',
            'tags' => 'required|exists:tags,id'
        ];
        $this->validate($request, $rules);

        if ($request->hasFile('video')) {
            $videoInput = $request->video->store('videos');
        }
        if ($request->hasFile('display_image')) {
            $imageInput = $request->display_image->store('images/videos');
        }

        $description = $request->description;
        $video = $playlist->videos()->create([
            'title' => $request->title,
            'description' => $description,
            'video' => $videoInput,
            'display_image' => $imageInput,
        ]);

        $video->tags()->attach($request->tags);
        session()->flash('success', "Video has been added to " .$playlist->title ." playlist successfully. You can add more if any.");
        return redirect()->back();
    }

    public function show(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video)
    {
        if (!($this->checkCourseSubCourseAndPlaylist($course, $subCourse, $playlist))) {
            return redirect(route('courses.subcourses.index', $course->slug));
        }
        if ($video->users()->find(auth()->id())) {
            $video->users()->updateExistingPivot(auth()->user(), array('updated_at' => now(), 'is_watch_later' => 0));
        } else {
            $video->users()->attach(auth()->id());
        }
        $flag = true;
        foreach ($video->playlist->videos as $eachVideo) {
            if (!($eachVideo->users()->find(auth()->id()))) {
                $flag = false;
            }
        }
        if ($flag) {
            $video->playlist->enrolledUsers()->updateExistingPivot(auth()->user(), array('is_completed' => 1));
        }
        return view('layouts.Video.show', compact(['course', 'subCourse', 'playlist', 'video']));
    }

    public function edit(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video)
    {
        $this->authorize('update', $video);
        $tags = Tag::all();
        return view('layouts.Video.edit', compact(['course', 'subCourse', 'playlist', 'video', 'tags']));
    }

    public function update(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video, Request $request)
    {
        if (!($this->checkCourseSubCourseAndPlaylist($course, $subCourse, $playlist))) {
            return redirect(route('courses.subcourses.index', $course->slug));
        }
        $this->authorize('update', $video);
        $rules = [
            'title' => 'required|max:60|unique:videos,title,' . $video->id,
            'description' => 'required',
            'video' => 'video|mimes:mp4,mov,ogg,webm|max:50000',
            'display_image' => 'image|mimes:jpeg,jpg,png|max:1000',
            'tags' => 'required|exists:tags,id'
        ];
        $this->validate($request, $rules);
        if ($request->hasFile('video')) {
            $video->deleteVideo();
            $videoInput = $request->video->store('videos');
        } else {
            $videoInput = $video->video;
        }
        $video->update([
            'title' => strtolower($request->title),
            'description' => $request->description,
            'video' => $videoInput,
        ]);
        $video->tags()->sync($request->tags);
        session()->flash('success', "Video Has Been Updated Successfully. Add More if any!");
        return redirect(route('courses.subcourses.playlists.videos.create', [$course, $subCourse, $playlist]));
    }

    public function destroy(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video)
    {
        if (!($this->checkCourseSubCourseAndPlaylist($course, $subCourse, $playlist))) {
            return redirect(route('courses.subcourses.index', $course->slug));
        }
        $this->authorize('delete', $video);
        $video->deleteVideo();
        $video->delete();

        session()->flash('success', "Video Has Been Deleted Successfully");
        return redirect(route('courses.subcourses.playlists.videos.create', [$course, $subCourse, $playlist]));
    }

    private function checkCourseSubCourseAndPlaylist(Course $course, SubCourse $subCourse, Playlist $playlist)
    {
        if (!($subCourse->course->id === $course->id && $playlist->subcourse->id === $subCourse->id)) {
            session()->flash('error', "It seems some phishing activity. Please Select respective Subcourses and Its Playlists!");
            return false;
        }
        return true;
    }
}
