<?php

namespace App\Filament\Student\Resources\MedicalHistoryResource\Pages;

use App\Filament\Student\Resources\MedicalHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMedicalHistories extends ManageRecords
{
    protected static string $resource = MedicalHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
