<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //HELPERS
    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    //Getters
    public function getImagePathAttribute()
    {
        return "storage/" . $this->image;
    }
    public function getUrlAttribute()
    {
        return "courses/{$this->slug}";
    }

    //MUTATORS
    public function setNameAttribute(String $name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    //SCOPES
    public function scopeSearch($query)
    {
        $search = request('search');
        if ($search) {
            return $query->where("name", "like", "%$search%");
        }
        return $query;
    }

    //RELATIONSHIPS
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
