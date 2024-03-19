<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CriminalHistoryResource\Pages;
use App\Models\CriminalHistory;
use App\Models\Student;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CriminalHistoryResource extends Resource
{
    protected static ?string $model = CriminalHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = 'criminal-history';

    protected static ?string $pluralLabel = 'criminal history';

    protected static ?string $label = 'criminal history';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('student_id')
                            ->relationship(
                                name: 'student',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query, string $operation) => $operation !== 'edit' ? $query->whereNotIn(
                                    'id',
                                    fn ($query) => $query->select('student_id')->from('criminal_history')
                                ) : $query
                            )
                            ->native(false)
                            ->preload()
                            ->required()
                            ->searchable()
                            ->disabledOn('edit')
                            ->unique(ignoreRecord: true)
                            ->afterStateHydrated(function (?string $state, Set $set) {
                                if ($state) {
                                    $set('matrix', Student::find($state)->matrix);
                                } else {
                                    $set('matrix', null);
                                }
                            })
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                if ($state) {
                                    $set('matrix', Student::find($state)->matrix);
                                } else {
                                    $set('matrix', null);
                                }
                            })
                            ->live(),
                        TextInput::make('matrix')
                            ->readOnly(),
                        Textarea::make('details')
                            ->required()
                            ->rows(10)
                            ->columnSpanFull(),
                    ])->columns(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('created_at')
                    ->hidden(),
                TextColumn::make('student.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('student.matrix')
                    ->label('Matrix')
                    ->searchable(),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCriminalHistories::route('/'),
            'create' => Pages\CreateCriminalHistory::route('/create'),
            'edit' => Pages\EditCriminalHistory::route('/{record}/edit'),
        ];
    }
}
