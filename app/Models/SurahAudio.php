<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurahAudio extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'reciter', 'file_path'];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}

