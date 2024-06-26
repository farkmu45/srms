<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function medicalHistory(): HasMany
    {
        return $this->hasMany(MedicalHistory::class);
    }

    public function criminalHistory(): HasMany
    {
        return $this->hasMany(CriminalHistory::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public static function booted(): void
    {
        static::creating(fn (Student $student) => $student['password'] = $student['matrix']);
    }
}
