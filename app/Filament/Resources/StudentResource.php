<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Password;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $label = 'student data';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralLabel = 'Student Data';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(200)
                            ->required(),
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
                        TextInput::make('password')
                            ->password()
                            ->columnSpanFull()
                            ->autocomplete('new-password')
                            ->revealable(true)
                            ->hiddenOn('create')
                            ->live(debounce: 500)
                            ->rule(Password::default())
                            ->dehydrated(fn ($state) => filled($state)),
                    ])->columns(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('matrix')
                    ->searchable(),
                TextColumn::make('semester')
                    ->sortable(),
                TextColumn::make('country.name')
                    ->label('Nationality')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
