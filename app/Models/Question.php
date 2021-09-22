<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;
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

    public function favoritesUserId()
    {
        return $this->views()->where('user_id', '=', auth()->id());
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
