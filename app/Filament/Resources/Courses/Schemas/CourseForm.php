<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('academic_coordination_id')
                    ->relationship('academicCoordination', 'name')
                    ->label('Coordenação')
                    ->native(false)
                    ->required(),
                TextInput::make('name')
                    ->label('Nome')
                    ->unique()
                    ->required(),
                TextInput::make('modality')
                    ->label('Modalidade')
                    ->required(),
            ]);
    }
}
