<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentAnswer;
use App\Models\AssignmentEntry;
use App\Models\Course;
use App\Models\Playlist;
use App\Models\Quiz;
use App\Models\QuizEntry;
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
    public function quiz()
    {
        $quizUndertaken = Quiz::where('user_id', auth()->id())->get();
        return view('layouts.Quiz.index', compact(['quizUndertaken']));
    }

    public function quizStart()
    {
        if (auth()->user()->role == 2) {
            $assignmentQuestions = [];
            foreach (Assignment::all() as $assignment) {
                foreach ($assignment->questions()->inRandomOrder()->limit(1)->get() as $question) {
                    $assignmentQuestions[] = $question;
                }
            }
            return view('layouts.Quiz.show', compact(['assignment', 'assignmentQuestions']));
        }
        session()->flash('error', 'Only Students can Take Quiz.');
        return redirect()->back();
    }

    public function Quizcheck(Request $request)
    {
        $quiz = Quiz::create([
            'user_id' => auth()->id(),
        ]);
        $array = $request->toArray();
        $lastKey = array_key_last($array);
        $count = (int)explode('id', $lastKey)[1];
        $marks = 0;
        for ($i = 1; $i <= $count; $i++) {
            $result = 0;
            if ($request->input('answer_id' . $i)) {
                $ans_id = $request->input('answer_id' . $i);
            } else {
                $ans_id = 0;
            }
            $ans = AssignmentAnswer::find($ans_id);
            if ($ans) {
                if ($ans->is_correct) {
                    $result = 1;
                    $marks++;
                }
                QuizEntry::create([
                    'user_id' => auth()->user()->id,
                    'assignment_question_id' => $request->input('question_id' . $i),
                    'assignment_answer_id' => $ans_id,
                    'result' => $result,
                    'quiz_id' => $quiz->id,
                ]);
            }
        }
        $quiz->update([
            'marks_obtained' => $marks,
            'total_questions' => $count,
        ]);
        session()->flash('success', 'Quiz has been submitted succesfully. Your score is ' . $marks . '/' . $count . 'Thank you');
        return redirect(route('quiz'));
    }

    public function quizAnalyze(Quiz $quiz)
    {
        if ($quiz->user_id === auth()->id()) {
            $questionAnswers = $quiz->quizEntries()->get();
            return view('layouts.Quiz.analysis', compact(['quiz', 'questionAnswers']));
        } else {
            session()->flash('error', 'You Can Only View Your Quiz Analysis');
            return redirect()->back();
        }
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
