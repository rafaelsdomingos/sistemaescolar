<?php

namespace App\Filament\Resources\Workshops\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;

class WorkshopForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('academic_year_id')
                    ->label('Ano letivo')
                    ->relationship('academicYear', 'year')
                    ->required(),
                Select::make('academic_coordination_id')
                    ->label('Coordenação')
                    ->relationship('academicCoordination', 'name')
                    ->required(),
                TextInput::make('name')
                    ->label('Nome da oficina')
                    ->required(),
                Datepicker::make('start_date')
                    ->label('Data de início')
                    ->required(),
                Datepicker::make('end_date')
                    ->label('Data de encerramento')
                    ->required(),
                Select::make('shift')
                    ->label('Turno')
                    ->options([
                        'Manhã' => 'Manhã',
                        'Tarde' => 'Tarde',
                        'Noite' => 'Noite'
                    ])
                    ->required(),
            ]);
    }
}
