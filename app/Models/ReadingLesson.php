<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingLesson extends Model
{
    protected $fillable = ['title', 'content'];

    public function quizzes()
    {
        return $this->hasMany(ReadingQuiz::class);
    }
}
