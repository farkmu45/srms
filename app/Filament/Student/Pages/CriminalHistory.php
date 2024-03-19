<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Page;

class CriminalHistory extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.student.pages.criminal-history';

    public ?string $criminalHistory = null;

    public function mount() {
        $this->criminalHistory = auth()->user()->criminalHistory->details;
    }
}
