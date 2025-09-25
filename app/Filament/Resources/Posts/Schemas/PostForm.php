<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Enums\AlignmentEnum;
use App\Models\Post;
use Exception;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
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
        return $schema->components([
                //
                Group::make()
                    ->schema([
                        Section::make('Conteúdo')
                            ->schema([
                                FileUpload::make('featured_image')
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
                                        self::heading(),
                                        self::paragraph(),
                                        self::imageSingle(),
                                        self::gallery(),
                                        self::quote(),
                                        self::video(),
                                        self::code(),
                                        self::separator(),
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
                                    ->required(),

                                Select::make('tags')
                                    ->label('Tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->preload(),
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


    /**
     * @throws Exception
     */
    private static function imageSingle()
    {
        return Block::make('image')
            ->label('Imagem')
            ->icon('heroicon-o-photo')
            ->schema([
                FileUpload::make('image')
                    ->label('Arquivo da Imagem')
                    ->directory('posts/content')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
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
                    ->options(AlignmentEnum::class)
                    ->default('center'),

                Builder::make('content')
                    ->label('Conteúdo')
                    ->columnSpanFull()
                    ->blocks([
                        self::heading(),
                        self::paragraph(),
                    ]),
            ])
            ->columns();
    }

    /**
     * @throws Exception
     */
    private static function separator()
    {
        return Block::make('separator')
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
            ]);
    }

    /**
     * @throws Exception
     */
    private static function gallery()
    {
        return Block::make('gallery')
            ->label('Galeria de Imagens')
            ->icon('heroicon-o-rectangle-stack')
            ->schema([
                FileUpload::make('images')
                    ->label('Imagens da Galeria')
                    ->directory('posts/galleries')
                    ->image()
                    ->multiple()
                    ->columnSpanFull()
                    ->disk('public')
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

                Textarea::make('description')
                    ->label('Descrição')
                    ->rows(2)
                    ->columnSpanFull()
                    ->placeholder('Descrição opcional da galeria...'),
            ])
            ->columns();
    }

    /**
     * @throws Exception
     */
    private static function code()
    {
        return Block::make('code')
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

                TextInput::make('filename')
                    ->label('Nome do Arquivo')
                    ->placeholder('exemplo.php (opcional)'),

                Textarea::make('content')
                    ->label('Código')
                    ->required()
                    ->rows(10)
                    ->columnSpanFull()
                    ->placeholder('Cole seu código aqui...')
                    ->extraAttributes([
                        'style' => 'font-family: monospace;'
                    ]),
            ])
            ->columns();
    }

    /**
     * @throws Exception
     */
    private static function video()
    {
        return Block::make('video')
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
            ->columns(1);
    }

    /**
     * @throws Exception
     */
    private static function quote()
    {
        return Block::make('quote')
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
            ->columns(1);
    }

    /**
     * @throws Exception
     */
    private static function heading()
    {
        return Block::make('heading')
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
            ->columns();
    }

    /**
     * @throws Exception
     */
    private static function paragraph()
    {
        return Block::make('paragraph')
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
            ]);
    }
}
