<?php

namespace App\Filament\Resources\Category\Schemas;

use App\Models\Category;
use Exception;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()->schema([
                TextInput::make(name: 'name')
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
                    ->unique(Category::class, 'slug', ignoreRecord: true)
                    ->rules(['alpha_dash']),

                Textarea::make('description')
                    ->label('Descrição')
                    ->rows(3)
                    ->columnSpanFull(),

                ColorPicker::make('color')
                    ->label('Cor')
                    ->default('#6366f1'),

                Toggle::make('is_active')
                    ->label('Ativo')
                    ->default(true),
            ])->columns(2),
        ])->columns(1);
    }
}
