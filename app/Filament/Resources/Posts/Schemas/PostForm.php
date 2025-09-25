<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Post;
use Exception;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Group::make()
                    ->schema([
                        Section::make('Conteúdo')
                            ->schema([
                                FileUpload::make('feature_image')
                                    ->directory('posts/featured')
                                    ->disk('public'),

                                TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn(string $context, $state, Set $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Post::class, 'slug', ignoreRecord: true)
                                    ->rules(['alpha_dash']),

                                Textarea::make('excerpt')
                                    ->label('Resumo')
                                    ->rows(3)
                                    ->maxLength(500),

                                Builder::make('content')
                                    ->label('Conteúdo')
                                    ->blocks([
                                        Block::make('heading')
                                            ->label('Título')
                                            ->icon('heroicon-o-h1')
                                            ->schema([
                                                TextInput::make('content')
                                                    ->label('Texto do Título')
                                                    ->required()
                                                    ->placeholder('Digite o título...'),
                                                Select::make('level')
                                                    ->label('Nível do Título')
                                                    ->options([
                                                        'h1' => 'Título 1 (H1)',
                                                        'h2' => 'Título 2 (H2)',
                                                        'h3' => 'Título 3 (H3)',
                                                        'h4' => 'Título 4 (H4)',
                                                        'h5' => 'Título 5 (H5)',
                                                        'h6' => 'Título 6 (H6)',
                                                    ])
                                                    ->default('h2')
                                                    ->required(),
                                            ])
                                            ->columns(),

                                        Block::make('paragraph')
                                            ->label('Parágrafo')
                                            ->icon('heroicon-o-document-text')
                                            ->schema([
                                                RichEditor::make('content')
                                                    ->label('Texto')
                                                    ->required()
                                                    ->placeholder('Digite o conteúdo do parágrafo...')
                                                    ->toolbarButtons([
                                                        'bold',
                                                        'italic',
                                                        'underline',
                                                        'strike',
                                                        'link',
                                                        'bulletList',
                                                        'orderedList',
                                                        'blockquote',
                                                        'codeBlock',
                                                    ]),
                                            ]),

                                        Block::make('image')
                                            ->label('Imagem')
                                            ->icon('heroicon-o-photo')
                                            ->schema([
                                                FileUpload::make('image')
                                                    ->label('Arquivo da Imagem')
                                                    ->directory('posts/content')
                                                    ->image()
                                                    ->imageEditor()
                                                    ->imageEditorAspectRatios([
                                                        null,
                                                        '16:9',
                                                        '4:3',
                                                        '1:1',
                                                    ])
                                                    ->maxSize(5120)
                                                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                                                    ->required()
                                                    ->helperText('Formatos aceitos: JPEG, PNG, WebP. Máximo 5MB.'),

                                                TextInput::make('alt')
                                                    ->label('Texto Alternativo')
                                                    ->required()
                                                    ->placeholder('Descreva a imagem para acessibilidade...')
                                                    ->helperText('Importante para SEO e acessibilidade'),

                                                TextInput::make('caption')
                                                    ->label('Legenda')
                                                    ->placeholder('Legenda opcional da imagem...'),

                                                Select::make('alignment')
                                                    ->label('Alinhamento')
                                                    ->options([
                                                        'left' => 'Esquerda',
                                                        'center' => 'Centro',
                                                        'right' => 'Direita',
                                                        'full' => 'Largura Total',
                                                    ])
                                                    ->default('center'),
                                            ])
                                            ->columns(),

                                        Block::make('gallery')
                                            ->label('Galeria de Imagens')
                                            ->icon('heroicon-o-rectangle-stack')
                                            ->schema([
                                                FileUpload::make('images')
                                                    ->label('Imagens da Galeria')
                                                    ->directory('posts/galleries')
                                                    ->image()
                                                    ->multiple()
                                                    ->reorderable()
                                                    ->maxFiles(10)
                                                    ->imageEditor()
                                                    ->maxSize(5120)
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                                    ->required()
                                                    ->helperText('Máximo 10 imagens.'),

                                                TextInput::make('title')
                                                    ->label('Título da Galeria')
                                                    ->placeholder('Título opcional para a galeria...'),

                                                Textarea::make('description')
                                                    ->label('Descrição')
                                                    ->rows(2)
                                                    ->placeholder('Descrição opcional da galeria...'),

                                                Select::make('layout')
                                                    ->label('Layout da Galeria')
                                                    ->options([
                                                        'grid-2' => 'Grade 2 Colunas',
                                                        'grid-3' => 'Grade 3 Colunas',
                                                        'grid-4' => 'Grade 4 Colunas',
                                                        'carousel' => 'Carrossel',
                                                        'masonry' => 'Mosaico',
                                                    ])
                                                    ->default('grid-3'),
                                            ])
                                            ->columns(),

                                        Block::make('image_text')
                                            ->label('Imagem + Texto')
                                            ->icon('heroicon-o-photo')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Título')
                                                    ->placeholder('Título opcional...'),

                                                FileUpload::make('image')
                                                    ->label('Imagem')
                                                    ->directory('posts/content')
                                                    ->image()
                                                    ->imageEditor()
                                                    ->required(),

                                                RichEditor::make('content')
                                                    ->label('Texto')
                                                    ->required()
                                                    ->toolbarButtons([
                                                        'bold',
                                                        'italic',
                                                        'link',
                                                        'bulletList',
                                                        'orderedList',
                                                    ]),

                                                Select::make('layout')
                                                    ->label('Layout')
                                                    ->options([
                                                        'image_left' => 'Imagem à esquerda',
                                                        'image_right' => 'Imagem à direita',
                                                        'image_top' => 'Imagem acima',
                                                        'image_bottom' => 'Imagem abaixo',
                                                    ])
                                                    ->default('image_left'),

                                                TextInput::make('alt')
                                                    ->label('Texto Alternativo')
                                                    ->required(),
                                            ])
                                            ->columns(),

                                        Block::make('quote')
                                            ->label('Citação')
                                            ->icon('heroicon-o-chat-bubble-left-right')
                                            ->schema([
                                                Textarea::make('content')
                                                    ->label('Texto da Citação')
                                                    ->required()
                                                    ->rows(3)
                                                    ->placeholder('Digite a citação...'),

                                                TextInput::make('author')
                                                    ->label('Autor')
                                                    ->placeholder('Nome do autor (opcional)'),

                                                TextInput::make('source')
                                                    ->label('Fonte')
                                                    ->placeholder('Fonte da citação (opcional)'),
                                            ])
                                            ->columns(1),

                                        Block::make('video')
                                            ->label('Vídeo')
                                            ->icon('heroicon-o-video-camera')
                                            ->schema([
                                                TextInput::make('url')
                                                    ->label('URL do Vídeo')
                                                    ->required()
                                                    ->url()
                                                    ->placeholder('https://youtube.com/watch?v=...')
                                                    ->helperText('YouTube, Vimeo ou URL direta'),

                                                TextInput::make('title')
                                                    ->label('Título do Vídeo')
                                                    ->placeholder('Título opcional...'),

                                                Textarea::make('description')
                                                    ->label('Descrição')
                                                    ->rows(2)
                                                    ->placeholder('Descrição opcional do vídeo...'),
                                            ])
                                            ->columns(1),

                                        Block::make('code')
                                            ->label('Código')
                                            ->icon('heroicon-o-code-bracket')
                                            ->schema([
                                                Select::make('language')
                                                    ->label('Linguagem')
                                                    ->options([
                                                        'php' => 'PHP',
                                                        'javascript' => 'JavaScript',
                                                        'html' => 'HTML',
                                                        'css' => 'CSS',
                                                        'sql' => 'SQL',
                                                        'json' => 'JSON',
                                                        'xml' => 'XML',
                                                        'bash' => 'Bash',
                                                        'python' => 'Python',
                                                        'java' => 'Java',
                                                        'other' => 'Outro',
                                                    ])
                                                    ->default('php'),

                                                Textarea::make('content')
                                                    ->label('Código')
                                                    ->required()
                                                    ->rows(10)
                                                    ->placeholder('Cole seu código aqui...')
                                                    ->extraAttributes([
                                                        'style' => 'font-family: monospace;'
                                                    ]),

                                                TextInput::make('filename')
                                                    ->label('Nome do Arquivo')
                                                    ->placeholder('exemplo.php (opcional)'),
                                            ])
                                            ->columns(),

                                        Block::make('separator')
                                            ->label('Separador')
                                            ->icon('heroicon-o-minus')
                                            ->schema([
                                                Select::make('style')
                                                    ->label('Estilo do Separador')
                                                    ->options([
                                                        'line' => 'Linha Simples',
                                                        'dots' => 'Pontos',
                                                        'stars' => 'Estrelas',
                                                        'space' => 'Espaço em Branco',
                                                    ])
                                                    ->default('line'),
                                            ]),
                                    ])
                                    ->blockNumbers(false)
                                    ->addActionLabel('Adicionar Bloco de Conteúdo')
                                    ->collapsible()
                                    ->cloneable()
                                    ->columnSpanFull()
                                    ->minItems(1),
                            ]),

                        Section::make('SEO')
                            ->schema([
                                KeyValue::make('meta_data')
                                    ->label('Meta Tags')
                                    ->keyLabel('Tag')
                                    ->valueLabel('Conteúdo')
                                    ->default([
                                        'meta_title' => '',
                                        'meta_description' => '',
                                        'meta_keywords' => '',
                                    ]),
                            ])
                            ->collapsible(),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Publicação')
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Rascunho',
                                        'published' => 'Publicado',
                                        'scheduled' => 'Agendado',
                                    ])
                                    ->default('draft')
                                    ->required()
                                    ->live(),

                                DateTimePicker::make('published_at')
                                    ->label('Data de Publicação')
                                    ->default(now())
                                    ->visible(fn(Get $get) => in_array($get('status'), ['published', 'scheduled'])),

                                TextInput::make('reading_time')
                                    ->label('Tempo de Leitura (min)')
                                    ->numeric()
                                    ->suffix('minutos')
                                    ->helperText('Deixe vazio para calcular automaticamente'),
                            ]),

                        Section::make('Relacionamentos')
                            ->schema([
                                Select::make('user_id')
                                    ->label('Autor')
                                    ->relationship('user', 'name')
                                    ->default(auth()->id())
                                    ->required(),

                                Select::make('category_id')
                                    ->label('Categoria')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Nome')
                                            ->required(),
                                        ColorPicker::make('color')
                                            ->label('Cor')
                                            ->default('#6366f1'),
                                    ]),

                                Select::make('tags')
                                    ->label('Tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Nome')
                                            ->required(),
                                        ColorPicker::make('color')
                                            ->label('Cor')
                                            ->default('#10b981'),
                                    ]),
                            ]),

                        Section::make('Estatísticas')
                            ->schema([
                                TextEntry::make('views_count')
                                    ->label('Visualizações')
                                    ->state(fn(Post $record): string => $record->views_count ?? '0'),

                                TextEntry::make('comments_count')
                                    ->label('Comentários')
                                    ->state(fn(Post $record): string => $record->comments_count ?? '0'),
                            ])
                            ->hiddenOn('create'),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])->columns(3);
    }
}
