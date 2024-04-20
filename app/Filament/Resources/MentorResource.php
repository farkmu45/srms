<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MentorResource\Pages;
use App\Models\Mentor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Password;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class MentorResource extends Resource
{
    protected static ?string $model = Mentor::class;

    protected static ?string $label = 'mentor data';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralLabel = 'Mentor Data';

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
                        TextInput::make('username')
                            ->maxLength(200)
                            ->unique(ignoreRecord: true)
                            ->required(),
                        PhoneInput::make('phone_number')
                            ->defaultCountry('my')
                            ->validateFor(type: PhoneNumberType::MOBILE)
                            ->initialCountry('my')
                            ->columnSpanFull()
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
                TextColumn::make('username')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->where('deleted_at', null))
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
            'index' => Pages\ListMentors::route('/'),
            'create' => Pages\CreateMentor::route('/create'),
            'edit' => Pages\EditMentor::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
