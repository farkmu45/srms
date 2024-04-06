<?php

namespace App\Filament\Mentor\Pages;

use App\Models\Achievement;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Achievements extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $view = 'filament.mentor.pages.achievements';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $title = 'Student Achievement';

    public function table(Table $table): Table
    {
        return $table
            ->query(Achievement::query())
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
                    ->label('Achievement')
                    ->wrap(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
