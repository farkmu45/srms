<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Page;

class MedicalHistory extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.student.pages.medical-history';

    public ?string $medicalHistory = null;

    public function mount()
    {
        $this->medicalHistory = auth()->user()->medicalHistory->details ?? null;
    }
}
