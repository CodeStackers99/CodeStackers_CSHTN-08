<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(QuizEntry::class, 'user_id');
    }
    public function quizEntries()
    {
        return $this->hasMany(QuizEntry::class);
    }
}
