<?php

namespace App\Filament\Resources\UserResource\Table;

use Exception;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class UserTable
{
    /**
     * @throws Exception
     */
    public static function make(Tables\Table $table): Tables\Table
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
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->modalWidth('md')
                        ->slideOver(),

                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
