<?php

namespace App\Filament\Mentor\Resources\MedicalHistoryResource\Pages;

use App\Filament\Mentor\Resources\MedicalHistoryResource;
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
