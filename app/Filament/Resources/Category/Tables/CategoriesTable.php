<?php

namespace App\Filament\Resources\Category\Tables;

use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    /**
     * @throws Exception
     */
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
                ->label('Nome')
                ->searchable()
                ->sortable(),

            TextColumn::make('slug')
                ->searchable()
                ->sortable()
                ->copyable(),

            ColorColumn::make('color')
                ->label('Cor'),

            TextColumn::make('posts_count')
                ->label('Posts')
                ->counts('posts')
                ->sortable(),

            IconColumn::make('is_active')
                ->label('Ativo')
                ->boolean()
                ->sortable(),

            TextColumn::make('created_at')
                ->label('Criado em')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                //
                TernaryFilter::make('is_active')
                    ->label('Ativo'),
            ])
            ->recordActions([
                EditAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
