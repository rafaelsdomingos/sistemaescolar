<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Enums\RaceColor;
use Filament\Forms\Components\Select;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('social_name'),
                TextInput::make('nationality')
                    ->required(),
                TextInput::make('birthplace'),
                TextInput::make('birthdate'),
                TextInput::make('gender'),
                Select::make('race_color')
                    ->label('Raça/Cor')
                    ->options(
                        collect(RaceColor::cases())
                            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
                            ->toArray()
                    )
                    ->required()
                    ->native(false)
            ]);
    }
}
