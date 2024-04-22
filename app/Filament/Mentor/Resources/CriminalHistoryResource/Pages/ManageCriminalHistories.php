<?php

namespace App\Filament\Mentor\Resources\CriminalHistoryResource\Pages;

use App\Filament\Mentor\Resources\CriminalHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCriminalHistories extends ManageRecords
{
    protected static string $resource = CriminalHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
