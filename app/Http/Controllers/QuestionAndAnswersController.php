<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsAndAnswersController extends Controller
{

    public function index()
    {
        $questions = Question::all();
        if (auth()->check()) {
            $favoriteQuestions = auth()->user()->views()->where('is_favorite', 1)->search()->latest()->paginate(10);
            $yourQuestions = auth()->user()->questions()->search()->latest()->paginate(10);
            $notificationsCount =  auth()->user()->unreadNotifications()->count();
            $questionsYouAnswered = auth()
                ->user()
                ->answers()
                ->with('question')
                ->get()
                ->pluck('question')
                ->unique();
            return view('layouts.Q&A.index', compact(['questions', 'favoriteQuestions', 'yourQuestions', 'questionsYouAnswered', 'notificationsCount']));
        }

        return view('layouts.Q&A.index', compact(['questions']));
    }

    public function yourQuestions()
    {
        $yourQuestions = auth()->user()->questions()->search()->latest()->paginate(10);
        return view('layouts.Q&A.your-questions', compact(['yourQuestions']));
    }

    public function favorites()
    {
        $favoriteQuestions = auth()->user()->views()->where('is_favorite', 1)->search()->latest()->paginate(10);
        return view('layouts.Q&A.favorite-questions', compact(['favoriteQuestions']));
    }

    public function questionsYouAnswerd()
    {
        $questionsYouAnswered = auth()
            ->user()
            ->answers()
            ->with('question')
            ->get()
            ->pluck('question')
            ->unique();

        return view('layouts.Q&A.questions-your-answered', compact(['questionsYouAnswered']));
    }
}
