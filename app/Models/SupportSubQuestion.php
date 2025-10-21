<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportSubQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['support_topic_id', 'question'];

    public function topic()
    {
        return $this->belongsTo(SupportTopic::class, 'support_topic_id');
    }
}
