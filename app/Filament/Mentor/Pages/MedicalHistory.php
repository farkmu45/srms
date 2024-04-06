<?php

namespace App\Filament\Mentor\Pages;

use App\Models\MedicalHistory as ModelsMedicalHistory;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class MedicalHistory extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $view = 'filament.mentor.pages.medical-history';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public function table(Table $table): Table
    {
        return $table
            ->query(ModelsMedicalHistory::query())
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
                    ->wrap()
            ])
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
