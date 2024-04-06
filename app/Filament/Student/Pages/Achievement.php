<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Page;

class Achievement extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static string $view = 'filament.student.pages.achievement';

    public ?string $achievement = null;

    public function mount()
    {
        $this->achievement = auth()->user()->achievement?->details ?? null;
    }
}
