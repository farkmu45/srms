<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\MedicalHistoryResource\Pages;
use App\Filament\Mentor\Resources\MedicalHistoryResource\RelationManagers;
use App\Models\MedicalHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalHistoryResource extends Resource
{
    protected static ?string $model = MedicalHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $slug = 'medical-history';

    protected static ?string $pluralLabel = 'medical history';

    protected static ?string $label = 'medical history';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('student', function($query) {
            $query->where('mentor_id', auth()->user()->id);
         });
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
                    ->limit(10),
            ])
            ->filters([
                //
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
            'index' => Pages\ManageMedicalHistories::route('/'),
        ];
    }
}
