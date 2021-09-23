<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    public const DISLIKE_CONST = -1;
    public const LIKE_CONST = 1;
    public const WATCH_LATER = 1;
    public const NOT_WATCH_LATER = 0;

    protected $guarded = ['id'];

    //MUTATORS
    public function setTitleAttribute(String $title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }

    //SCOPES
    public function scopeSearch($query)
    {
        $search = request('search');
        if ($search) {
            return $query->where("title", "like", "%$search%");
        }
        return $query;
    }

    //RELATIONSHIPS
    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot(['is_watch_later']);
    }

}
