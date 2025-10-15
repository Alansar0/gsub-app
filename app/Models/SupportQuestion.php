<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportQuestion extends Model
{
    protected $fillable = ['category_id', 'question', 'custom_whatsapp_link'];

    public function category()
    {
        return $this->belongsTo(SupportCategory::class);
    }
}
