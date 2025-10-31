<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $fillable = ['title', 'file_path'];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
