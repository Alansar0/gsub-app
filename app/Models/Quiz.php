<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['audio_id', 'question', 'options', 'correct_answer'];

    protected $casts = [
        'options' => 'array',
    ];

    public function audio()
    {
        return $this->belongsTo(Audio::class);
    }
}
