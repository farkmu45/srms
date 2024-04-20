<?php

namespace App\Livewire;

use App\Models\Student;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Livewire\Component;

class Submission extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('student_id')
                    ->label('Student')
                    ->options(Student::all()->pluck('name', 'id'))
                    ->native(false)
                    ->live()
                    ->searchable()
                    ->afterStateUpdated(function (?string $state, Set $set) {
                        if ($state) {
                            $set('matrix', Student::find($state)->matrix);
                        } else {
                            $set('matrix', null);
                        }
                    })
                    ->required(),
                TextInput::make('matrix')
                    ->readOnly(),
                TextInput::make('case')
                    ->required()
                    ->maxLength(200),
                Select::make('type')
                    ->options([
                        'CRIMINAL' => 'Criminal History',
                        'MEDICAL' => 'Medical History',
                        'ACHIEVEMENT' => 'Achievement',
                    ])
                    ->required(),
                Textarea::make('details')
                    ->rows(10)
                    ->required(),
                FileUpload::make('proof')
                    ->directory('proofs')
            ])
            ->statePath('data');
    }
    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render()
    {
        return view('livewire.submission');
    }
}
