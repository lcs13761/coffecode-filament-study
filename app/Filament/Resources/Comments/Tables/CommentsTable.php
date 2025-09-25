<?php

namespace App\Filament\Resources\Comments\Tables;

use App\Models\Comment;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('post.title')
                    ->label('Post')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                TextColumn::make('author_name')
                    ->label('Autor')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('content')
                    ->label('Comentário')
                    ->limit(50)
                    ->searchable()
                    ->wrap(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                        'gray' => 'spam',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'approved' => 'Aprovado',
                        'rejected' => 'Rejeitado',
                        'spam' => 'Spam',
                    })
                    ->sortable(),

                IconColumn::make('parent_id')
                    ->label('Resposta')
                    ->boolean()
                    ->trueIcon('heroicon-o-arrow-turn-down-right')
                    ->falseIcon('')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pendente',
                        'approved' => 'Aprovado',
                        'rejected' => 'Rejeitado',
                        'spam' => 'Spam',
                    ]),

                SelectFilter::make('post')
                    ->relationship('post', 'title')
                    ->searchable()
                    ->preload(),

                TernaryFilter::make('parent_id')
                    ->label('Tipo')
                    ->placeholder('Todos')
                    ->trueLabel('Respostas')
                    ->falseLabel('Comentários principais')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('parent_id'),
                        false: fn (Builder $query) => $query->whereNull('parent_id'),
                    ),
            ])
            ->recordActions([
                EditAction::make(),


                Action::make('approve')
                    ->label('Aprovar')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (Comment $record): bool => $record->status !== 'approved')
                    ->action(fn (Comment $record) => $record->approve()),

                Action::make('reject')
                    ->label('Rejeitar')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn (Comment $record): bool => $record->status !== 'rejected')
                    ->action(fn (Comment $record) => $record->reject()),

                Action::make('spam')
                    ->label('Marcar como Spam')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->color('warning')
                    ->visible(fn (Comment $record): bool => $record->status !== 'spam')
                    ->action(fn (Comment $record) => $record->markAsSpam()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                    BulkAction::make('approve')
                        ->label('Aprovar selecionados')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function (Collection $records): void {
                            $records->each->approve();
                        }),

                    BulkAction::make('reject')
                        ->label('Rejeitar selecionados')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->action(function (Collection $records): void {
                            $records->each->reject();
                        }),
                ]),
            ])->defaultSort('created_at', 'desc');
    }
}
