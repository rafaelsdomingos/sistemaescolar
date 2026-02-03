<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Workshop extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'academic_coordination_id',
        'academic_year_id',
        'name',
        'shift'
    ];

    public function academicCoordination(): BelongsTo
    {
        return $this->belongsTo(AcademicCoordination::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function enrollments(): MorphMany
    {
        return $this->morphMany(Enrollment::class, 'enrollable');
    }
}
