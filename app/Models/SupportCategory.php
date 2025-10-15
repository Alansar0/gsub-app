<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportCategory extends Model
{
    protected $fillable = ['title', 'default_whatsapp_link'];

    public function questions()
    {
        return $this->hasMany(SupportQuestion::class, 'category_id');
    }
}
