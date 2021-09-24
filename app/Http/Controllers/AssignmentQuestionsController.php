<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentQuestion;
use App\Models\Course;
use App\Models\Playlist;
use App\Models\SubCourse;
use App\Models\Video;
use Illuminate\Http\Request;

class AssignmentQuestionsController extends Controller
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
    public function create(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video, Assignment $assignment)
    {
        return view('', compact(['course', 'subCourse', 'playlist', 'video', 'assignment']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, SubCourse $subCourse, Playlist $playlist, Video $video, Assignment $assignment, Request $request)
    {
        $rules = [
            'question_text' => 'required',
            'asnwer_text_1' => 'required',
            'asnwer_text_2' => 'required',
            'asnwer_text_3' => 'required',
            'asnwer_text_4' => 'required',
            'is_correct' => 'required|min:1,max:4',
        ];

        $this->validate($request, $rules);
        $question = $assignment->questions()->create([
            'question_text' => $request->question_text,
        ]);
        for ($i = 1; $i <= 4; $i++) {
            $question->assignmentAnswers()->create([
                'answer_text' => $request->answer_text_ . $i,
                'is_correct' => $request->is_correct == $i ? 1 : 0,
            ]);
        }

        session()->flash('success', 'Question And Its Options Added Successfully');
        return redirect(route('courses.subcourses.playlists.videos.assignment.question.create', compact(['course', 'subCourse', 'playlist', 'video', 'assignment'])));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignmentQuestion  $assignmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(AssignmentQuestion $assignmentQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignmentQuestion  $assignmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentQuestion $assignmentQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignmentQuestion  $assignmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignmentQuestion $assignmentQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignmentQuestion  $assignmentQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentQuestion $assignmentQuestion)
    {
        //
    }
}
