<?php

namespace App\Filament\Resources\Tags\Schemas;

use App\Models\Tag;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;


class TagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                //
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn (string $context, $state, Set $set) =>
                                $context === 'create' ? $set('slug', Str::slug($state)) : null
                            ),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Tag::class, 'slug', ignoreRecord: true)
                            ->rules(['alpha_dash']),

                        ColorPicker::make('color')
                            ->label('Cor')
                            ->default('#10b981'),
                    ])
            ]);
    }
}
