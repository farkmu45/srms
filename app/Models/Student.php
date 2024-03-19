<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Webpatser\Countries\Countries;

class Student  extends Authenticatable implements FilamentUser
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Countries::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
