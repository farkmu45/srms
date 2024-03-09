<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webpatser\Countries\Countries;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function country() : BelongsTo {
        return $this->belongsTo(Countries::class);
    }
}
