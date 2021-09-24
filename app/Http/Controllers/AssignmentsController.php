<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentAnswer;
use App\Models\AssignmentEntry;
use App\Models\Course;
use App\Models\Playlist;
use App\Models\SubCourse;
use App\Models\Video;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    public function create(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video)
    {
        if (!($video->assignment()->exists())) {
            return view('', compact(['course', 'subCourse', 'playlist', 'video']));
        } else {
            session()->flash('error', 'Assignment Already Created');
            return redirect()->back();
        }
    }

    public function store(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video, Request $request)
    {
        $rules = [
            'title' => 'required|max:40',
            'description' => 'required'
        ];

        $this->validate($request, $rules);

        $assignment = $video->assignment()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        session()->flash('success', 'New Assignment Created. Add Questions To It');
        return redirect(route('courses.subcourses.playlists.videos.assignment.question.create', [$course, $subCourse, $playlist, $video, $assignment]));
    }

    public function show(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video, Assignment $assignment)
    {
        $assignmentQuestions = $assignment->questions()->get();
        return view('layouts.Assignemnt.show', compact(['course', 'subCourse', 'playlist', 'assignmentQuestions', 'video', 'assignment']));
    }

    public function check(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video, Assignment $assignment, Request $request)
    {
        $noOfQuestions = $assignment->questions()->count();
        $marks = 0;
        for ($i = 1; $i <= $noOfQuestions; $i++) {
            $ans = AssignmentAnswer::find($request->input('answer_id' . $i));
            if ($ans->is_correct) {
                $marks++;
            }
            AssignmentEntry::create([
                'user_id' => auth()->user()->id,
                'assignment_id' => $assignment->id,
                'assignment_question_id' => $request->input('question_id' . $i),
                'assignment_answer_id' => $request->input('answer_id' . $i),
                'result' => $ans->is_correct
            ]);
        }
        $assignment->usersAttempted()->attach([auth()->id()]);
        $assignment->usersAttempted()->updateExistingPivot(auth()->id(), array('marks_obtained' => $marks));

        session()->flash('success', 'Assignment has been submitted succesfully. Your score is ' . $marks . '/' . $noOfQuestions . 'Thank you');
        return redirect(route('courses.subcourses.playlists.videos.show', [$course->slug, $subCourse->slug, $playlist->slug, $video->slug]));
    }
    public function quiz(Assignment $assignment)
    {
        if (auth()->user()->role == 2) {
            $assignmentQuestions = [];
            foreach (Assignment::all() as $assignment) {
                foreach ($assignment->questions()->inRandomOrder()->limit(1)->get() as $question) {
                    $assignmentQuestions[] = $question;
                }
            }
            dd($assignmentQuestions);
        }
        session()->flash('error', 'Only Students can Take Quiz.');
        return redirect()->back();
    }

    public function analyze()
    {

        if (auth()->user()->role == 0) {
            $assignments = auth()->user()->playlists()->with('videos.assignment')->get()->pluck('videos')->flatten()->pluck('assignment');
            return view('', compact(['assignments']));
        }
        session()->flash('error', 'Only Students can Take Quiz.');
        return redirect()->back();
    }
}
