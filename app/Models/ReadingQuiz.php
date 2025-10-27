<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingQuiz extends Model
{
    protected $fillable = [
        'reading_lesson_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer'
    ];

    public function lesson()
    {
        return $this->belongsTo(ReadingLesson::class);
    }
}
}
