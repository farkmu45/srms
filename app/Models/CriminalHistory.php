<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CriminalHistory extends Model
{
    use HasFactory;

    protected $table = 'medical_history';

    protected $guarded = [''];

    protected $primaryKey = 'student_id';

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
