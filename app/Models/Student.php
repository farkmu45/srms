<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable implements FilamentUser
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
        return $this->belongsTo(Country::class);
    }

    public function medicalHistory(): HasOne
    {
        return $this->hasOne(MedicalHistory::class);
    }

    public function criminalHistory(): HasOne
    {
        return $this->hasOne(CriminalHistory::class);
    }

    public function achievement(): HasOne
    {
        return $this->hasOne(Achievement::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public static function booted() : void
    {
        static::creating(fn (Student $student) => $student['password'] = $student['matrix']);
    }
}
