<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages;
use App\Models\Achievement;
use App\Models\CriminalHistory;
use App\Models\MedicalHistory;
use App\Models\Submission;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('student.name'),
                TextEntry::make('student.matrix')
                    ->label('Matrix'),
                TextEntry::make('case'),
                TextEntry::make('details')
                    ->columnSpanFull(),
                ImageEntry::make('proof'),
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
                TextColumn::make('case')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                TextColumn::make('student.matrix')
                    ->label('Matrix')
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('is_approved')
                    ->label('Status')
                    ->options([
                        false => 'Pending',
                        true => 'Approved',
                    ])
                    ->default(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSubmissions::route('/'),
        ];
    }
}
