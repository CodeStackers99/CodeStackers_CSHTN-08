<?php

namespace App\Models;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const USER_TEACHER = 0;
    const USER_ADMIN = 1;
    const USER_STUDENT = 2;
    const STUDENT_BRANCH_AI = 3;
    const STUDENT_BRANCH_CS = 4;
    const STUDENT_BRANCH_DS = 5;
    const STUDENT_BRANCH_IT = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //BOOT METHOD

    protected static function boot()
    {
        parent::boot();

        self::created(function (User $user) {
            retry(5, function () use ($user) {
                Mail::to($user)->send(new WelcomeMail($user));
            });
        });
    }

    // GETTERS

    public function getImagePathAttribute()
    {
        $image = $this->image;
        if ($image == null) {
            return "https://ui-avatars.com/api/?name={$this->name}&rounded=true&size=120";
        }
        return asset('storage/' . $image);
    }

    public function getVerificationPathAttribute()
    {
        $image = $this->verification_id;
        return asset('storage/' . $image);
    }

    public static function generateVerificationCode()
    {
        return Str::random(40);
    }
    // HELPER FUNCTIONS
    public function isAdmin()
    {
        return $this->role === self::USER_ADMIN;
    }

    public function isTeacher()
    {
        return $this->role === self::USER_TEACHER;
    }

    public function isStudent()
    {
        return $this->role === self::USER_STUDENT;
    }

    public function hasQuestionUpVote(Question $question)
    {
        return auth()->user()->votesQuestions()->where(['vote' => 1, 'vote_id' => $question->id, 'vote_type' => Question::class])->exists();
    }
    public function hasQuestionDownVote(Question $question)
    {
        return auth()->user()->votesQuestions()->where(['vote' => -1, 'vote_id' => $question->id, 'vote_type' => Question::class])->exists();
    }
    public function hasVoteForQuestion(Question $question)
    {
        return $this->hasQuestionUpVote($question) || $this->hasQuestionDownVote($question);
    }

    public function hasAnswerUpVote(Answer $answer)
    {
        return auth()->user()->votesAnswers()->where(['vote' => 1, 'vote_id' => $answer->id, 'vote_type' => Answer::class])->exists();
    }
    public function hasAnswerDownVote(Answer $answer)
    {
        return auth()->user()->votesAnswers()->where(['vote' => -1, 'vote_id' => $answer->id, 'vote_type' => Answer::class])->exists();
    }
    public function hasVoteForAnswer(Answer $answer)
    {
        return $this->hasAnswerUpVote($answer) || $this->hasAnswerDownVote($answer);
    }
    public function votesQuestions()
    {
        return $this->morphedByMany(Question::class, 'vote')->withTimestamps();
    }
    public function votesAnswers()
    {
        return $this->morphedByMany(Answer::class, 'vote')->withTimestamps();
    }

    // Relationships
    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function views()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function subCourses()
    {
        return $this->hasMany(SubCourse::class);
    }
    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }
    public function videos()
    {
        return $this->belongsToMany(Video::class)->withTimestamps()->withPivot(['is_watch_later', 'reactions']);
    }
    public function enrolledPlaylist()
    {
        return $this->belongsToMany(Playlist::class)->withTimestamps()->withPivot('is_completed');
    }
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    public function assignmentsAttempted()
    {
        return $this->belongsToMany(Assignment::class)->withPivot('marks_obtained')->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
