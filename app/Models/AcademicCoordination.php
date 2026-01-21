<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicCoordination extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicCoordinationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'coordinator',
        'phone',
        'email',
    ];
}
