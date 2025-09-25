<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = Faker::create('pt_BR');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::where('status', 'published')->get();
        $users = User::all();

        foreach ($posts as $post) {
            // Cada post terá entre 0 e 8 comentários
            $commentsCount = rand(0, 8);
            
            for ($i = 0; $i < $commentsCount; $i++) {
                $isGuest = rand(1, 3) === 1; // 33% chance de ser comentário de visitante
                
                $comment = Comment::create([
                    'post_id' => $post->id,
                    'user_id' => $isGuest ? null : $users->random()->id,
                    'parent_id' => null, // Por enquanto apenas comentários principais
                    'author_name' => $isGuest ? $this->faker->name : null,
                    'author_email' => $isGuest ? $this->faker->email : null,
                    'author_website' => $isGuest && rand(1, 4) === 1 ? $this->faker->url : null,
                    'content' => $this->faker->paragraph(rand(1, 3)),
                    'status' => $this->faker->randomElement(['approved', 'pending', 'spam']),
                    'ip_address' => $this->faker->ipv4,
                    'user_agent' => $this->faker->userAgent,
                ]);

                // 30% chance de ter respostas
                if (rand(1, 10) <= 3) {
                    $repliesCount = rand(1, 3);
                    
                    for ($j = 0; $j < $repliesCount; $j++) {
                        $isGuestReply = rand(1, 4) === 1; // 25% chance de resposta de visitante
                        
                        Comment::create([
                            'post_id' => $post->id,
                            'user_id' => $isGuestReply ? null : $users->random()->id,
                            'parent_id' => $comment->id,
                            'author_name' => $isGuestReply ? $this->faker->name : null,
                            'author_email' => $isGuestReply ? $this->faker->email : null,
                            'author_website' => null,
                            'content' => $this->faker->paragraph(rand(1, 2)),
                            'status' => $this->faker->randomElement(['approved', 'pending']),
                            'ip_address' => $this->faker->ipv4,
                            'user_agent' => $this->faker->userAgent,
                        ]);
                    }
                }
            }
        }
    }
}
