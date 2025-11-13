<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Reseller;


class VoucherProfile extends Model {

    protected $guarded = [];

    public function reseller(){

        return $this->belongsTo(Reseller::class);
    }

}

