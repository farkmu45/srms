<?php

namespace App\Filament\Pages;

use App\Models\Submission as ModelsSubmission;
use Filament\Pages\Page;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Submission extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $view = 'filament.pages.submission';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Submission';

    public function table(Table $table): Table
    {
        return $table
            ->query(ModelsSubmission::query())
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
                TextColumn::make('case')
                ->sortable()
                ->searchable()
                    ->wrap(),
                IconColumn::make('is_verified')
                    ->label('Verified')
                    ->sortable()
                    ->boolean()
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
