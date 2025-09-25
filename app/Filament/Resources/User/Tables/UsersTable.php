<?php

namespace App\Filament\Resources\User\Tables;

use Exception;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class UsersTable
{
    /**
     * @throws Exception
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->modelLabel(__('locale.labels.user'))
            ->columns([

                //name
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('locale.labels.name')),

                //email
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label(__('locale.labels.email')),

                //roles
                TextColumn::make('roles.name')
                    ->separator()
                    ->formatStateUsing(fn (string $state) => Str::ucfirst($state))
                    ->colors([
                        'text-gray-500 dark:text-gray-300',
                        'text-red-500',
                        'text-amber-500',
                        'text-lime-500',
                    ])
                    ->badge()
                    ->label(__('locale.labels.roles')),

                //active
                ToggleColumn::make('active')
                    ->label(__('locale.labels.active')),

                //created_at
                TextColumn::make('created_at')
                    ->dateTime('d/m/y H:i')
                    ->label(__('locale.labels.created_at')),

                //updated_at
                TextColumn::make('updated_at')
                    ->dateTime('d/m/y H:i')
                    ->label(__('locale.labels.updated_at')),
            ])
            ->filters([
                TernaryFilter::make('active')
                    ->nullable()
                    ->label(__('locale.labels.active'))
                    ->queries(
                        true: fn (Builder $query) => $query->where('active', true),
                        false: fn (Builder $query) => $query->where('active', false),
                    ),

                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->label(__('locale.labels.roles')),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()
                        ->modalWidth('md')
                        ->slideOver(),

                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
