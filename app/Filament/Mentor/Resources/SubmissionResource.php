<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\SubmissionResource\Pages;
use App\Filament\Mentor\Resources\SubmissionResource\RelationManagers;
use App\Models\Achievement;
use App\Models\CriminalHistory;
use App\Models\MedicalHistory;
use App\Models\Submission;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            ->filters([
                SelectFilter::make('is_approved')
                    ->label('Status')
                    ->options([
                        false => 'Pending',
                        true => 'Approved',
                    ])
                    ->default(false)
            ])
            ->actions([
                Action::make('approve')
                    ->requiresConfirmation()
                    ->disabled(fn (Submission $record) => $record->is_approved)
                    ->action(function (Submission $record) {

                        $type = $record->type;
                        $data = $record->toArray();

                        switch ($type) {
                            case 'CRIMINAL':
                                CriminalHistory::create($data);
                                break;
                            case 'MEDICAL':
                                MedicalHistory::create($data);
                                break;
                            case 'ACHIEVEMENT':
                                Achievement::create($data);
                                break;
                        }
                        $record->is_approved = true;
                        $record->save();
                    }),
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