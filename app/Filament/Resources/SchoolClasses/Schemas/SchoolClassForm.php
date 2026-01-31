<?php

namespace App\Filament\Resources\SchoolClasses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SchoolClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('course_id')
                    ->relationship('course', 'name')
                    ->required(),
                Select::make('academic_year_id')
                    ->relationship('academicYear', 'id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('shift')
                    ->required(),
            ]);
    }
}
