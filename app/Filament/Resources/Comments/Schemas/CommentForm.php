<?php

namespace App\Filament\Resources\Comments\Schemas;

use App\Models\Comment;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                //
                Group::make()
                    ->schema([
                        Section::make('Comentário')
                            ->schema([
                                Select::make('post_id')
                                    ->label('Post')
                                    ->relationship('post', 'title')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Select::make('parent_id')
                                    ->label('Resposta para')
                                    ->relationship('parent', 'id')
                                    ->getOptionLabelFromRecordUsing(
                                        fn (Comment $record): string =>
                                        "#{$record->id} - " . \Illuminate\Support\Str::limit($record->content, 50)
                                    )
                                    ->searchable()
                                    ->preload(),

                                Textarea::make('content')
                                    ->label('Conteúdo')
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Section::make('Autor')
                            ->schema([
                                Select::make('user_id')
                                    ->label('Usuário')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->preload(),

                                TextInput::make('author_name')
                                    ->label('Nome do Autor')
                                    ->maxLength(255)
                                    ->visible(condition: fn (Get $get): bool => !$get('user_id')),

                                TextInput::make('author_email')
                                    ->label('Email do Autor')
                                    ->email()
                                    ->maxLength(255)
                                    ->visible(fn (Get $get): bool => !$get('user_id')),

                                TextInput::make('author_website')
                                    ->label('Website do Autor')
                                    ->url()
                                    ->maxLength(255)
                                    ->visible(condition: fn (Get $get): bool => !$get('user_id')),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Status')
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'pending' => 'Pendente',
                                        'approved' => 'Aprovado',
                                        'rejected' => 'Rejeitado',
                                        'spam' => 'Spam',
                                    ])
                                    ->required()
                                    ->default('pending'),
                            ]),

                        Section::make('Informações Técnicas')
                            ->schema([
                                TextInput::make('ip_address')
                                    ->label('Endereço IP')
                                    ->disabled(),

                                Textarea::make('user_agent')
                                    ->label('User Agent')
                                    ->disabled()
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ]);
    }
}
