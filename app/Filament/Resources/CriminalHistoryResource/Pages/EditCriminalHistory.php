<?php

namespace App\Filament\Resources\CriminalHistoryResource\Pages;

use App\Filament\Resources\CriminalHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCriminalHistory extends EditRecord
{
    protected static string $resource = CriminalHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
