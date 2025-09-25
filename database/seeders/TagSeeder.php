<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'PHP', 'slug' => 'php', 'color' => '#777BB4'],
            ['name' => 'Laravel', 'slug' => 'laravel', 'color' => '#FF2D20'],
            ['name' => 'Filament', 'slug' => 'filament', 'color' => '#FDBA74'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'color' => '#F7DF1E'],
            ['name' => 'Vue.js', 'slug' => 'vuejs', 'color' => '#4FC08D'],
            ['name' => 'React', 'slug' => 'react', 'color' => '#61DAFB'],
            ['name' => 'Node.js', 'slug' => 'nodejs', 'color' => '#339933'],
            ['name' => 'MySQL', 'slug' => 'mysql', 'color' => '#4479A1'],
            ['name' => 'PostgreSQL', 'slug' => 'postgresql', 'color' => '#336791'],
            ['name' => 'Docker', 'slug' => 'docker', 'color' => '#2496ED'],
            ['name' => 'Git', 'slug' => 'git', 'color' => '#F05032'],
            ['name' => 'API', 'slug' => 'api', 'color' => '#FF6B6B'],
            ['name' => 'REST', 'slug' => 'rest', 'color' => '#4ECDC4'],
            ['name' => 'GraphQL', 'slug' => 'graphql', 'color' => '#E10098'],
            ['name' => 'TDD', 'slug' => 'tdd', 'color' => '#95E1D3'],
            ['name' => 'Clean Code', 'slug' => 'clean-code', 'color' => '#A8E6CF'],
            ['name' => 'SOLID', 'slug' => 'solid', 'color' => '#FFD93D'],
            ['name' => 'Design Patterns', 'slug' => 'design-patterns', 'color' => '#FF8B94'],
            ['name' => 'Performance', 'slug' => 'performance', 'color' => '#C7CEEA'],
            ['name' => 'Security', 'slug' => 'security', 'color' => '#FFEAA7'],
            ['name' => 'Tutorial', 'slug' => 'tutorial', 'color' => '#DDA0DD'],
            ['name' => 'Tips', 'slug' => 'tips', 'color' => '#98D8C8'],
            ['name' => 'Best Practices', 'slug' => 'best-practices', 'color' => '#F7DC6F'],
            ['name' => 'Beginner', 'slug' => 'beginner', 'color' => '#AED6F1'],
            ['name' => 'Advanced', 'slug' => 'advanced', 'color' => '#F1948A'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
