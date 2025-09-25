<?php

namespace App\Filament\Resources\User\Schemas;

use App\Models\Role;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
                Section::make()->schema([
                    //name
                    TextInput::make('name')
                        ->required()
                        ->label(__('locale.labels.name'))
                        ->placeholder(__('locale.labels.name'))
                        ->columnSpanFull(),

                    //email
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->label(__('locale.labels.email'))
                        ->placeholder(__('locale.labels.email'))
                        ->columnSpanFull(),

//                    TextInput::make('phone_number')
//                        ->extraAlpineAttributes(['x-mask:dynamic' => '$input.length > 14 ? \'(99) 99999-9999\' : \'(99) 9999-9999\''])
//                        ->label(__('locale.labels.phone_number'))
//                        ->required()
//                        ->placeholder(__('locale.labels.phone_number'))
//                        ->columnSpanFull(),

                    //password
                    TextInput::make('password')
                        ->password()
                        ->required(fn($context): bool => $context === 'create')
                        ->confirmed()
                        ->revealable()
                        ->minLength(8)
                        ->label(__('locale.labels.password'))
                        ->placeholder(__('locale.labels.password'))
                        ->dehydrateStateUsing(fn($state): string => Hash::make($state))
                        ->dehydrated(fn($state): bool => filled($state))
                        ->autocomplete(false)
                        ->same('password_confirmation')
                        ->visibleOn(['create', 'edit'])
                        ->columnSpanFull(),

                    //password confirmation
                    TextInput::make('password_confirmation')
                        ->password()
                        ->revealable()
                        ->label(__('locale.labels.password_confirmation'))
                        ->placeholder(__('locale.labels.password_confirmation'))
                        ->required(fn($context): bool => $context === 'create')
                        ->dehydrated(false)
                        ->visibleOn(['create', 'edit'])
                        ->columnSpanFull(),

                    Select::make('role')
                        ->multiple()
                        ->required()
                        ->relationship('roles', 'name')
                        ->options(
                            Role::select(['id', 'name'])
                                ->pluck('name', 'id')
                                ->sortKeys()
                                ->map(fn($value) => Str::ucfirst($value))
                                ->toArray()
                        )
                        ->label(__('locale.labels.roles'))
                        ->columnSpanFull(),

                    Toggle::make('active')
                        ->inline(false)
                        ->label(__('locale.labels.active'))
                        ->default(true)
                        ->columnSpanFull(),
                ])->columns(12)

            ])->columns(1);
    }
}
