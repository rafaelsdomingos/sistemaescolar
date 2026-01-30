<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'academic_coordination_id',
        'name',
        'modality'
    ];

    public function academicCoordination(): BelongsTo
    {
        return $this->belongsTo(AcademicCoordination::class);
    }
}
