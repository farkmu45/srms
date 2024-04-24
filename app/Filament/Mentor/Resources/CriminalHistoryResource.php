<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\CriminalHistoryResource\Pages;
use App\Models\CriminalHistory;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CriminalHistoryResource extends Resource
{
    protected static ?string $model = CriminalHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';

    protected static ?string $slug = 'criminal-history';

    protected static ?string $pluralLabel = 'criminal history';

    protected static ?string $label = 'criminal history';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('student', function ($query) {
            $query->where('mentor_id', auth()->user()->id);
        });
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('student.name'),
                TextEntry::make('student.matrix')
                    ->label('Matrix'),
                TextEntry::make('details')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('student.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('student.matrix')
                    ->label('Matrix')
                    ->searchable(),
                TextColumn::make('details')
                    ->label('Criminal History')
                    ->limit(20),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCriminalHistories::route('/'),
        ];
    }
}
