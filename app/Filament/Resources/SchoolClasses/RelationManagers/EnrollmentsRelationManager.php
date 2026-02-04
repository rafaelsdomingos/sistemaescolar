<?php

namespace App\Filament\Resources\SchoolClasses\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\EnrollStatus;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Validation\Rule;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    protected static ?string $title = 'Estudantes matriculados';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->relationship('student', 'name')
                    ->label('Estudante')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->rules([
                        fn (Get $get, $record) =>
                            Rule::unique('enrollments', 'student_id')
                                ->where('enrollable_id', $this->getOwnerRecord()->id)
                                ->where('enrollable_type', get_class($this->getOwnerRecord()))
                                ->ignore($record?->id),
                    ])
                    ->validationMessages([
                        'unique' => 'Este aluno já está matriculado nesta turma.',
                    ]),
                DatePicker::make('start_date')
                    ->label('Data de abertura de matrícula')
                    ->default(now())
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Data de fechamento de matrícula'),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        collect(EnrollStatus::cases())
                            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
                            ->toArray()
                    ])
                    ->native(false)
                    ->required(),
                TextInput::make('notes')
                    ->label('Observações'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('enrollment_id')
            ->columns([
                TextColumn::make('student.name')
                    ->label('Estudante')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Data de matrícula')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->formatStateUsing(fn (?EnrollStatus $state) => $state?->label())
                    ->badge()
                    ->color(fn (?EnrollStatus $state): string => match ($state) {
                        EnrollStatus::cursando => 'info',
                        EnrollStatus::aprovado => 'success',
                        EnrollStatus::reprovado => 'danger',
                        EnrollStatus::abandono => 'danger',
                        EnrollStatus::trancado => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('notes')
                    ->label('Observações')
                    ->searchable(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Nova matrícula')
                    ->modalHeading('Matricular estudante'),
                //AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                //DissociateAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}
