<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Notifications\TooManyFavorites;
use Illuminate\Http\Request;

class FavoriteQuestionController extends Controller
{
    public function favorite(Question $question)
    {
        $question->favoritesUserId()->update(['is_favorite' => 1]);
        if ($question->favorites_count % 10 == 0) {
            $question->owner->notify(new TooManyFavorites($question));
        }
        session()->flash('success', 'Question is added to favorites!');
        return redirect()->back();
    }
    public function unfavorite(Question $question)
    {
        $question->favoritesUserId()->update(['is_favorite' => 0]);
        session()->flash('success', 'Question has been removed from favorites!');
        return redirect()->back();
    }
}
