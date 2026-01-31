<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolClass extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_id',
        'academic_year_id',
        'name',
        'shift'
    ];

    public function course(): BelongsTo 
    {
        return $this->belongsTo(Course::class);
    }

    public function academicYear(): BelongsTo 
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
