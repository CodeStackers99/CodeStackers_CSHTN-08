<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentAnswer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //RELATIONSHIPS
    public function assignmentQuestions()
    {
        return $this->belongsTo(AssignmentQuestion::class, 'assignment_question_id');
    }
}
