<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Playlist extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //HELPERS
    public function deleteImage()
    {
        Storage::delete($this->display_image);
    }

    //Getters
    public function getImagePathAttribute()
    {
        return "storage/" . $this->display_image;
    }
    public function getUrlAttribute()
    {
        return $this->subCourse->url . "/playlists/{$this->slug}";
    }

    //MUTATORS
    public function setTitleAttribute(String $title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }
    //RELATIONSHIPS
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function subcourse()
    {
        return $this->belongsTo(SubCourse::class, 'sub_course_id');
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
    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('is_completed');
    }
}
