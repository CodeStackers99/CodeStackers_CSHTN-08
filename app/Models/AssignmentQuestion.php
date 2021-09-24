<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentQuestion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //RELATIONSHIPS
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignmnet_id');
    }

    public function assignmentAnswers()
    {
        return $this->hasMany(AssignmentAnswer::class);
    }
}
