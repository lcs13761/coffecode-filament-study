<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PostsTable
{
    /**
     * @throws Exception
     */
    public static function configure(Table $table): Table
    {
        return $table->columns([
            //
            Tables\Columns\ImageColumn::make('featured_image')
                ->label('Imagem')
                ->visibility('public')
                ->imageSize(60),

            Tables\Columns\TextColumn::make('title')
                ->label('Título')
                ->searchable()
                ->sortable()
                ->limit(50),

            // Tables\Columns\TextColumn::make('category.name')
            //     ->label('Categoria')
            //     ->badge()
            //     ->color(fn (Post $record): string => $record->category?->color ?? 'gray')
            //     ->sortable(),

            Tables\Columns\TextColumn::make('user.name')
                ->label('Autor')
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    'draft' => 'gray',
                    'published' => 'success',
                    'scheduled' => 'warning',
                })
                ->formatStateUsing(fn(string $state): string => match ($state) {
                    'draft' => 'Rascunho',
                    'published' => 'Publicado',
                    'scheduled' => 'Agendado',
                })
                ->sortable(),

            Tables\Columns\TextColumn::make('published_at')
                ->label('Publicado em')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('views_count')
                ->label('Visualizações')
                ->numeric()
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('comments_count')
                ->label('Comentários')
                ->counts('comments')
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Criado em')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Rascunho',
                        'published' => 'Publicado',
                        'scheduled' => 'Agendado',
                    ]),

                // Tables\Filters\SelectFilter::make('category')
                //     ->relationship('category', 'name')
                //     ->label('Categoria'),

                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->label('Autor'),

                Tables\Filters\Filter::make('published_at')
                    ->form([
                        DatePicker::make('published_from')
                            ->label('Publicado de'),
                        DatePicker::make('published_until')
                            ->label('Publicado até'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),

                    Action::make('publish')
                        ->label('Publicar')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->visible(fn(Post $record): bool => $record->status !== 'published')
                        ->action(function (Post $record): void {
                            $record->update([
                                'status' => 'published',
                                'published_at' => now(),
                            ]);
                        })
                        ->requiresConfirmation(),

                    Action::make('unpublish')
                        ->label('Despublicar')
                        ->icon('heroicon-o-eye-slash')
                        ->color('warning')
                        ->visible(fn(Post $record): bool => $record->status === 'published')
                        ->action(function (Post $record): void {
                            $record->update(['status' => 'draft']);
                        })
                        ->requiresConfirmation(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                    BulkAction::make('publish')
                        ->label('Publicar selecionados')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(function (Collection $records): void {
                            $records->each(function (Post $record): void {
                                $record->update([
                                    'status' => 'published',
                                    'published_at' => now(),
                                ]);
                            });
                        })
                        ->requiresConfirmation(),
                ]),
            ])->defaultSort('created_at', 'desc');
    }
}
