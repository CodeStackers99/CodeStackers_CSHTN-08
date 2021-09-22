<?php

namespace App\Models;

use App\Helpers\Votable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;
    use Votable;
    protected $guarded = ['id'];

    //Getters
    public function getUrlAttribute()
    {
        return "questions/{$this->slug}";
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getAnswerStyleAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "has-best-answer";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getFavoritesCountAttribute()
    {
        return $this->views()->where('is_favorite', 1)->count();
    }
    public function getIsFavoriteAttribute()
    {
        return $this->favoritesUserId()->where('is_favorite', 1)->count() > 0;
    }
    public function getFavoriteStyleAttribute()
    {
        if ($this->getIsFavoriteAttribute()) {
            return 'text-danger';
        }
        return 'text-black-50';
    }
    public function getViewsCountAttribute()
    {
        return $this->views->count();
    }
    public function getIsViewedAttribute()
    {
        return $this->favoritesUserId()->count() > 0;
    }

    //MUTATORS
    public function setTitleAttribute(String $title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }


    /**
     * SCOPES
     */
    public function scopeSearch($query)
    {
        $search = request('search');
        if ($search) {
            return $query->where("title", "like", "%$search%")->orWhere("body", "like", "%$search%");
        }
        return $query;
    }

    //Helpers
    public function favoritesUserId()
    {
        return $this->views()->where('user_id', '=', auth()->id());
    }

    public function viewsCountIncrement()
    {
        if ((auth()->check()) && ($this->owner->id != auth()->id()) && !($this->is_viewed)) {
            $this->views()->attach(auth()->id());
        }
    }

    //Relationships
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function votes()
    {
        return $this->morphToMany(User::class, 'vote')->withTimestamps();
    }
    public function views()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
