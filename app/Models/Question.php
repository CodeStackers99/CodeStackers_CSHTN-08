<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


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
