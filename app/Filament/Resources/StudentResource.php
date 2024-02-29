<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $label = 'student data';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralLabel = 'Student Data';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(200)
                            ->required(),
                        TextInput::make('matrix')
                            ->maxLength(12)
                            ->minLength(12)
                            ->required()
                            ->numeric(),
                        Select::make('semester')
                            ->options(
                                range(1, 8)
                            )->required(),
                        TextInput::make('origin')
                            ->required()
                            ->maxLength(200),
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
                TextColumn::make('id')
                    ->hidden(),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('matrix')
                    ->searchable(),
                TextColumn::make('semester')
                    ->sortable(),
                TextColumn::make('origin')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('id', 'desc')
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
