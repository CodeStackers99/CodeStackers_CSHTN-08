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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video)
    {
        if (!($video->assignment()->exists())) {
            return view('', compact(['course', 'subCourse', 'playlist', 'video']));
        } else {
            session()->flash('error', 'Assignment Already Created');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        $assignmentQuestion = $assignment->questions()->get();
        return view('', compact(['assignmentQuestion']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }

    public function check(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video, Assignment $assignment, Request $request)
    {
        $noOfQuestions = $assignment->questions()->count();
        $marks = 0;
        for ($i = 1; $i <= $noOfQuestions; $i++) {
            if ((AssignmentAnswer::find($request->answer_id . $i)->isCorrect)) {
                $marks++;
            }
            AssignmentEntry::create([
                'user_id' => auth()->user()->id,
                'assignment_id' => $assignment->id,
                'assignment_question_id' => $request->question_id . $i,
                'assignment_answer_id' => $request->answer_id . $i,
                'result' => (AssignmentAnswer::find($request->answer_id . $i)->isCorrect) ? 0 : 1,
            ]);
        }
        $assignment->usersAttempted()->attach([auth()->id()]);
        $assignment->usersAttempted()->updateExistingPivot(auth()->id(), array('marks_obtained' => $marks));
        return redirect(route('courses.subcourses.playlists.videos.show', [$course, $subCourse, $playlist, $video]));
    }
}
