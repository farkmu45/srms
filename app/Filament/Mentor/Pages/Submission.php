<?php

namespace App\Filament\Mentor\Pages;

use App\Models\Achievement;
use App\Models\CriminalHistory;
use App\Models\Submission as ModelsSubmission;
use Filament\Tables\Actions\Action;
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
            ->query(ModelsSubmission::whereHas('student', function($query) {
               $query->where('mentor_id', auth()->user()->id);
            }))
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
                TextColumn::make('details')
                    ->label('Detail')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                TextColumn::make('proof')
                    ->limit(20)
                    ->url(fn (ModelsSubmission $record): string => asset('storage/' . $record->proof))
                    ->openUrlInNewTab(),

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('approve')
                    ->requiresConfirmation()
                    ->disabled(fn (ModelsSubmission $record) => $record->is_verified)
                    ->action(function (ModelsSubmission $record) {

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

                        $record->is_verified = true;
                        $record->save();
                    })
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
