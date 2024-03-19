<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                TextInput::make('matrix')
                    ->maxLength(12)
                    ->minLength(12)
                    ->required()
                    ->numeric(),
                Select::make('semester')
                    ->options(
                        range(1, 8)
                    )->required(),
                Select::make('country_id')
                    ->relationship('country', 'name')
                    ->preload()
                    ->required()
                    ->label('Nationality')
                    ->searchable(),
                DatePicker::make('date_of_birth')
                    ->required()
                    ->native(false)
                    ->displayFormat('Y-m-d')
                    ->maxDate(now()),
                PhoneInput::make('phone_number')
                    ->defaultCountry('my')
                    ->validateFor(type: PhoneNumberType::MOBILE)
                    ->initialCountry('my')
                    ->required(),
                TextInput::make('parent_name')
                    ->required()
                    ->maxLength(200),
                PhoneInput::make('parent_phone_number')
                    ->defaultCountry('my')
                    ->validateFor(type: PhoneNumberType::MOBILE)
                    ->initialCountry('my')
                    ->required(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
