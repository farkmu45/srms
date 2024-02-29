<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalHistoryResource\Pages;
use App\Models\MedicalHistory;
use App\Models\Student;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MedicalHistoryResource extends Resource
{
    protected static ?string $model = MedicalHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $slug = 'medical-history';

    protected static ?string $pluralLabel = 'medical history';

    protected static ?string $label = 'medical history';

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
                                modifyQueryUsing: fn (Builder $query) => $query->whereNotIn(
                                    'id',
                                    fn ($query) => $query->select('student_id')->from('medical_history')
                                )
                            )
                            ->native(false)
                            ->preload()
                            ->required()
                            ->searchable()
                            ->unique()
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
                        RichEditor::make('details')
                            ->required()
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMedicalHistories::route('/'),
            'create' => Pages\CreateMedicalHistory::route('/create'),
            'edit' => Pages\EditMedicalHistory::route('/{record}/edit'),
        ];
    }
}
