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

    //Relationships
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
