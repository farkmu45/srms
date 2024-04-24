<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\SubmissionResource\Pages;
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

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


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
                ImageEntry::make('proof')
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
