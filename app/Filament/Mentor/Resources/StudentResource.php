<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\StudentResource\Pages;
use App\Filament\Mentor\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $pluralLabel = 'student data';

    protected static ?string $label = 'student data';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('mentor_id', auth()->user()->id);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name'),
                TextEntry::make('matrix'),
                TextEntry::make('semester'),
                TextEntry::make('date_of_birth'),
                TextEntry::make('country.name'),
                TextEntry::make('phone_number'),
                TextEntry::make('parent_name'),
                TextEntry::make('parent_phone_number'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('matrix')
                    ->searchable(),
                TextColumn::make('semester')
                    ->sortable(),
                TextColumn::make('country.name')
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageStudents::route('/'),
        ];
    }
}
