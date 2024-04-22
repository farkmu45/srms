<?php

namespace App\Filament\Mentor\Resources\AchievementResource\Pages;

use App\Filament\Mentor\Resources\AchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAchievements extends ManageRecords
{
    protected static string $resource = AchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
