<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tecnologia',
                'slug' => 'tecnologia',
                'description' => 'Artigos sobre tecnologia, programação e inovação.',
                'color' => '#3B82F6',
                'is_active' => true,
            ],
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Tutoriais e dicas sobre o framework Laravel.',
                'color' => '#EF4444',
                'is_active' => true,
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'description' => 'Conteúdo sobre PHP e suas melhores práticas.',
                'color' => '#8B5CF6',
                'is_active' => true,
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'description' => 'Artigos sobre JavaScript, frameworks e bibliotecas.',
                'color' => '#F59E0B',
                'is_active' => true,
            ],
            [
                'name' => 'Filament',
                'slug' => 'filament',
                'description' => 'Tutoriais sobre Filament PHP.',
                'color' => '#10B981',
                'is_active' => true,
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'Conteúdo sobre DevOps, CI/CD e infraestrutura.',
                'color' => '#6366F1',
                'is_active' => true,
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'Artigos sobre UI/UX e design de interfaces.',
                'color' => '#EC4899',
                'is_active' => true,
            ],
            [
                'name' => 'Carreira',
                'slug' => 'carreira',
                'description' => 'Dicas de carreira para desenvolvedores.',
                'color' => '#14B8A6',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
