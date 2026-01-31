<?php

namespace App\Filament\Resources\Workshops\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WorkshopForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('academic_year_id')
                    ->relationship('academicYear', 'id')
                    ->required(),
                Select::make('academic_coordination_id')
                    ->relationship('academicCoordination', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('shift')
                    ->required(),
            ]);
    }
}
