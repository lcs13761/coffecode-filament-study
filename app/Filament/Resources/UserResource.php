<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Form\UserForm;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Table\UserTable;
use App\Models\User;
use Exception;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('locale.labels.user');
    }

    public static function getPluralModelLabel(): string
    {
        return __('locale.labels.users');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('locale.labels.users');
    }

    public static function getNavigationLabel(): string
    {
        return __('locale.labels.users');
    }

    public static function form(Form $form): Form
    {
        return UserForm::make($form);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return UserTable::make($table);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
