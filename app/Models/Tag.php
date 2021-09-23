<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

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
    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
