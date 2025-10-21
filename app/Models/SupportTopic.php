<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTopic extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'whatsapp_link'];

    public function subQuestions()
    {
        return $this->hasMany(SupportSubQuestion::class);
    }
}
