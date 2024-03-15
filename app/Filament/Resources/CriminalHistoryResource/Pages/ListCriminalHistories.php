<?php

namespace App\Filament\Resources\CriminalHistoryResource\Pages;

use App\Filament\Resources\CriminalHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCriminalHistories extends ListRecords
{
    protected static string $resource = CriminalHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
