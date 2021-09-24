<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //Getters
    public function getUrlAttribute()
    {
        return $this->video->url . "/assignments/{$this->id}";
    }

    // RELATIONSHIPS

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function questions()
    {
        return $this->hasMany(AssignmentQuestion::class);
    }

    public function usersAttempted()
    {
        return $this->belongsToMany(User::class)->withPivot('marks_obtained')->withTimestamps();
    }
}
