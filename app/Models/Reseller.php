<?php

namespace App\Models;
use App\Models\User;
use App\Models\Router;
use App\Models\VoucherProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model {
    protected $guarded = [];

    public function user(){

        return $this->belongsTo(User::class);

    }
    public function router(){

        return $this->hasOne(Router::class);

    }
    public function profiles(){

        return $this->hasMany(VoucherProfile::class, 'reseller_id');

    }
}

