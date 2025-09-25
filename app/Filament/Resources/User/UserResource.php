<?php

namespace App\Filament\Resources\User;

use App\Filament\Resources\User\Schemas\UserForm;
use App\Filament\Resources\User\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Exception;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedUsers;


    public static function getModelLabel(): string
    {
        return __('User');
    }


    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
