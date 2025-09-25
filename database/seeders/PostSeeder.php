<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        // Garantir que temos usuários, categorias e tags
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::all();

        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->error('Você precisa executar UserSeeder e CategorySeeder primeiro!');
            return;
        }

        Storage::makeDirectory('posts/content');
        Storage::makeDirectory('posts/featured');
        Storage::makeDirectory('posts/galleries');

        // Criar 20 posts com conteúdo em blocos
        for ($i = 0; $i < 20; $i++) {
            $post = Post::create([
                'featured_image' => $this->generateFeaturedImage(),
                'title' => $faker->sentence(rand(3, 8)),
                'slug' => $faker->unique()->slug,
                'excerpt' => $faker->paragraph(2),
                'content' => $this->generateRandomBlocks($faker),
                'status' => $faker->randomElement(['draft', 'published', 'scheduled']),
                'published_at' => $faker->dateTimeBetween('-6 months', '+1 month'),
                'reading_time' => rand(3, 15),
                'views_count' => rand(0, 5000),
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'meta_data' => [
                    'meta_title' => $faker->sentence(5),
                    'meta_description' => $faker->paragraph(1),
                    'meta_keywords' => implode(', ', $faker->words(5)),
                ],
            ]);

            // Anexar tags aleatórias
            if ($tags->isNotEmpty()) {
                $post->tags()->attach(
                    $tags->random(rand(1, min(4, $tags->count())))->pluck('id')
                );
            }

            $this->command->info("Post '$post->title' criado com sucesso!");
        }
    }

    /**
     * @return string|null
     */
    private function generateFeaturedImage(): ?string
    {
        $filename = "feature_" . time() . '_' . rand(1000, 9999) . '.jpg';
        $path = "posts/featured/$filename";

        $width = rand(800, 1200);
        $height = rand(400, 800);

        $this->downloadImage("https://picsum.photos/$width/$height?random=" . rand(1, 1000), $path);

        return $path;
    }

    /**
     * Gera blocos aleatórios para o conteúdo
     */
    private function generateRandomBlocks($faker): array
    {
        $blocks = [];
        $numBlocks = rand(5, 12);

        $blockTypes = [
            'heading', 'paragraph', 'image', 'gallery',
            'image_text', 'quote', 'code', 'video', 'separator'
        ];

        for ($i = 0; $i < $numBlocks; $i++) {
            $blockType = $faker->randomElement($blockTypes);

            switch ($blockType) {
                case 'heading':
                    $blocks[] = [
                        'type' => 'heading',
                        'data' => [
                            'content' => $faker->sentence(rand(2, 6)),
                            'level' => $faker->randomElement(['h1', 'h2', 'h3', 'h4', 'h5', 'h6']),
                        ],
                    ];
                    break;

                case 'paragraph':
                    $blocks[] = [
                        'type' => 'paragraph',
                        'data' => [
                            'content' => $this->generateRichText($faker),
                        ],
                    ];
                    break;

                case 'image':
                    $imagePath = $this->generateContentImage( 'single');
                    $blocks[] = [
                        'type' => 'image',
                        'data' => [
                            'image' => $imagePath,
                            'alt' => $faker->sentence(3),
                            'caption' => $faker->optional(0.7)->sentence(5),
                            'alignment' => $faker->randomElement(['left', 'center', 'right', 'full']),
                        ],
                    ];
                    break;

                case 'gallery':
                    $galleryImages = $this->generateContentGallery();
                    $blocks[] = [
                        'type' => 'gallery',
                        'data' => [
                            'images' => $galleryImages,
                            'title' => $faker->optional(0.6)->sentence(4),
                            'description' => $faker->optional(0.5)->paragraph(1),
                            'layout' => $faker->randomElement(['grid-2', 'grid-3', 'grid-4', 'carousel', 'masonry']),
                        ],
                    ];
                    break;

                case 'image_text':
                    $imagePath = $this->generateContentImage('text');
                    $blocks[] = [
                        'type' => 'image_text',
                        'data' => [
                            'title' => $faker->optional(0.8)->sentence(4),
                            'image' => $imagePath,
                            'content' => $this->generateRichText($faker),
                            'layout' => $faker->randomElement(['image_left', 'image_right', 'image_top', 'image_bottom']),
                            'alt' => $faker->sentence(3),
                        ],
                    ];
                    break;

                case 'quote':
                    $blocks[] = [
                        'type' => 'quote',
                        'data' => [
                            'content' => $faker->paragraph(2),
                            'author' => $faker->optional(0.8)->name,
                            'source' => $faker->optional(0.5)->company,
                            // Removido 'style' que não existe no form
                        ],
                    ];
                    break;

                case 'code':
                    $language = $faker->randomElement(['php', 'javascript', 'html', 'css', 'sql', 'json', 'xml', 'bash', 'python', 'java', 'other']);
                    $blocks[] = [
                        'type' => 'code',
                        'data' => [
                            'language' => $language,
                            'content' => $this->generateCodeSnippet($faker, $language),
                            'filename' => $faker->optional(0.6)->word . '.' . $this->getFileExtension($language),
                        ],
                    ];
                    break;

                case 'video':
                    $blocks[] = [
                        'type' => 'video',
                        'data' => [
                            'url' => $faker->randomElement([
                                'https://youtube.com/watch?v=' . $faker->regexify('[A-Za-z0-9_-]{11}'),
                                'https://vimeo.com/' . $faker->numberBetween(100000000, 999999999),
                            ]),
                            'title' => $faker->optional(0.8)->sentence(4),
                            'description' => $faker->optional(0.7)->paragraph(1),
                        ],
                    ];
                    break;

                case 'separator':
                    $blocks[] = [
                        'type' => 'separator',
                        'data' => [
                            'style' => $faker->randomElement(['line', 'dots', 'stars', 'space']),
                        ],
                    ];
                    break;
            }
        }

        return $blocks;
    }

    /**
     * Gera uma imagem para os blocos de conteúdo
     */
    private function generateContentImage( $type = 'content'): string
    {
        $filename = "content_{$type}_" . time() . '_' . rand(1000, 9999) . '.jpg';
        $path = "posts/content/$filename";

        $dimensions = match($type) {
            'text' => '600/400',
            default => '800/600'
        };

        $this->downloadImage("https://picsum.photos/$dimensions?random=" . rand(1, 1000), $path);

        return $path;
    }

    /**
     * Gera galeria para bloco de conteúdo
     */
    private function generateContentGallery(): array
    {
        $images = [];
        $numImages = rand(2, 5);

        for ($i = 0; $i < $numImages; $i++) {
            $filename = "gallery_content_" . time() . "_{$i}_" . rand(1000, 9999) . '.jpg';
            $path = "posts/galleries/$filename";

            $this->downloadImage("https://picsum.photos/600/450?random=" . rand(1, 1000), $path);
            $images[] = $path;
        }

        return $images;
    }

    /**
     * Simula o download da imagem
     */
    private function downloadImage(string $url, string $path): void
    {
        try {
            $imageContent = file_get_contents($url);
            if ($imageContent !== false) {
                Storage::put($path, $imageContent);
            } else {
                // Fallback: criar uma imagem placeholder simples
                Storage::put($path, 'Placeholder image content');
            }
        } catch (Exception $e) {
            // Em caso de erro, criar placeholder
            Storage::put($path, 'Placeholder image content');
        }
    }

    /**
     * Gera texto rico com HTML
     */
    private function generateRichText($faker): string
    {
        $paragraphs = [];
        $numParagraphs = rand(1, 3);
        $limit = 1;

        for ($i = 0; $i < $numParagraphs; $i++) {
            $paragraph = $faker->paragraph(rand(3, 8));

            // Adicionar formatação aleatória
            if ($faker->boolean(30)) {
                $words = explode(' ', $paragraph);
                $boldWord = $faker->randomElement($words);
                $paragraph = str_replace($boldWord, "<strong>$boldWord</strong>", $paragraph, $limit);
            }

            if ($faker->boolean(20)) {
                $words = explode(' ', $paragraph);
                $italicWord = $faker->randomElement($words);
                $paragraph = str_replace($italicWord, "<em>$italicWord</em>", $paragraph, $limit);
            }

            if ($faker->boolean(15)) {
                $words = explode(' ', $paragraph);
                $linkWord = $faker->randomElement($words);
                $paragraph = str_replace($linkWord, "<a href=\"#\">$linkWord</a>", $paragraph, $limit);
            }

            if ($faker->boolean(10)) {
                $words = explode(' ', $paragraph);
                $underlineWord = $faker->randomElement($words);
                $paragraph = str_replace($underlineWord, "<u>$underlineWord</u>", $paragraph, $limit);
            }

            if ($faker->boolean(8)) {
                $words = explode(' ', $paragraph);
                $strikeWord = $faker->randomElement($words);
                $paragraph = str_replace($strikeWord, "<s>$strikeWord</s>", $paragraph, $limit);
            }

            $paragraphs[] = "<p>$paragraph</p>";
        }

        // Adicionar listas ocasionalmente
        if ($faker->boolean(25)) {
            $listItems = [];
            for ($j = 0; $j < rand(3, 6); $j++) {
                $listItems[] = "<li>{$faker->sentence(rand(3, 8))}</li>";
            }
            $listType = $faker->randomElement(['ul', 'ol']);
            $paragraphs[] = "<$listType>" . implode('', $listItems) . "</$listType>";
        }

        // Adicionar blockquotes ocasionalmente
        if ($faker->boolean(15)) {
            $paragraphs[] = "<blockquote><p>{$faker->paragraph()}</p></blockquote>";
        }

        // Adicionar code blocks ocasionalmente
        if ($faker->boolean(10)) {
            $codeExample = $faker->randomElement([
                '$variable = "example";',
                'function example() { return true; }',
                'const example = () => console.log("Hello");'
            ]);
            $paragraphs[] = "<pre><code>$codeExample</code></pre>";
        }

        return implode('', $paragraphs);
    }

    /**
     * Gera snippets de código
     */
    private function generateCodeSnippet($faker, $language): string
    {
        $codeSnippets = [
            'php' => [
                "<?php\n\nclass BlogPost {\n    public function __construct(\n        public string \$title,\n        public string \$content\n    ) {}\n\n    public function getSlug(): string {\n        return Str::slug(\$this->title);\n    }\n}",
                "<?php\n\n\$posts = Post::published()\n    ->with(['author', 'category'])\n    ->latest()\n    ->paginate(10);\n\nforeach (\$posts as \$post) {\n    echo \$post->title . \"\\n\";\n}",
                "<?php\n\nRoute::get('/blog/{slug}', function (string \$slug) {\n    \$post = Post::where('slug', \$slug)->firstOrFail();\n    \n    return view('blog.show', compact('post'));\n})->name('blog.show');",
            ],
            'javascript' => [
                "// Gerenciador de comentários\nclass CommentManager {\n    constructor(postId) {\n        this.postId = postId;\n        this.init();\n    }\n\n    async init() {\n        await this.loadComments();\n        this.bindEvents();\n    }\n\n    async loadComments() {\n        const response = await fetch(`/api/posts/\${this.postId}/comments`);\n        const comments = await response.json();\n        this.renderComments(comments);\n    }\n}",
                "// Sistema de busca em tempo real\nconst searchInput = document.getElementById('search');\nconst resultsContainer = document.getElementById('results');\n\nconst debounce = (func, wait) => {\n    let timeout;\n    return (...args) => {\n        clearTimeout(timeout);\n        timeout = setTimeout(() => func.apply(this, args), wait);\n    };\n};\n\nconst search = debounce(async (query) => {\n    if (query.length < 3) return;\n    \n    const response = await fetch(`/search?q=\${query}`);\n    const results = await response.json();\n    \n    displayResults(results);\n}, 300);",
            ],
            'html' => [
                "<article class=\"blog-post\">\n    <header>\n        <h1>{{ \$post->title }}</h1>\n        <div class=\"meta\">\n            <time datetime=\"{{ \$post->published_at->format('Y-m-d') }}\">\n                {{ \$post->published_at->format('d/m/Y') }}\n            </time>\n            <span class=\"author\">Por {{ \$post->author->name }}</span>\n        </div>\n    </header>\n    \n    <div class=\"content\">\n        {!! \$post->content !!}\n    </div>\n</article>",
            ],
            'css' => [
                ".blog-post {\n    max-width: 800px;\n    margin: 0 auto;\n    padding: 2rem;\n    line-height: 1.6;\n}\n\n.blog-post header {\n    margin-bottom: 2rem;\n    border-bottom: 1px solid #eee;\n    padding-bottom: 1rem;\n}\n\n.blog-post h1 {\n    font-size: 2.5rem;\n    margin-bottom: 0.5rem;\n    color: #333;\n}",
            ],
            'python' => [
                "# Sistema de blog em Django\nfrom django.db import models\nfrom django.utils.text import slugify\n\nclass BlogPost(models.Model):\n    title = models.CharField(max_length=200)\n    slug = models.SlugField(unique=True)\n    content = models.TextField()\n    published_at = models.DateTimeField(auto_now_add=True)\n    \n    def save(self, *args, **kwargs):\n        if not self.slug:\n            self.slug = slugify(self.title)\n        super().save(*args, **kwargs)",
            ],
            'sql' => [
                "-- Consulta para posts mais populares\nSELECT \n    p.title,\n    p.slug,\n    p.views_count,\n    u.name as author,\n    COUNT(cm.id) as comments_count\nFROM posts p\nINNER JOIN users u ON p.user_id = u.id\nLEFT JOIN comments cm ON p.id = cm.post_id\nWHERE p.status = 'published'\nGROUP BY p.id\nORDER BY p.views_count DESC\nLIMIT 10;",
            ],
        ];

        return $faker->randomElement($codeSnippets[$language] ?? ["// Exemplo de código em $language\nconsole.log('Hello World!');"]);
    }


    /**
     * Retorna a extensão do arquivo baseada na linguagem
     */
    private function getFileExtension(string $language): string
    {
        return match($language) {
            'php' => 'php',
            'javascript' => 'js',
            'html' => 'html',
            'css' => 'css',
            'python' => 'py',
            'sql' => 'sql',
            'json' => 'json',
            'xml' => 'xml',
            'bash' => 'sh',
            'java' => 'java',
            default => 'txt'
        };
    }
}
