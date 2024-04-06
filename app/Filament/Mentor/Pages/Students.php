<?php

namespace App\Filament\Mentor\Pages;

use App\Models\Student as ModelsStudent;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Students extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $view = 'filament.mentor.pages.student';

    protected static ?string $title = 'Student Data';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public function table(Table $table): Table
    {
        return $table
            ->query(ModelsStudent::query())
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
