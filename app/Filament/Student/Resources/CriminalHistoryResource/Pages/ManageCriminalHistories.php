<?php

namespace App\Filament\Student\Resources\CriminalHistoryResource\Pages;

use App\Filament\Student\Resources\CriminalHistoryResource;
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
