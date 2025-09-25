<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PostShow extends Component
{
    use WithPagination;

    public Post $post;
    public $comment = '';
    public $replyTo = null;
    public $showCommentForm = false;

    protected $rules = [
        'comment' => 'required|min:10|max:1000',
    ];

    public function mount(Post $post)
    {
        // Increment view count
        $post->increment('views_count');

        // Load relationships
        $post->load(['category', 'tags', 'user']);
    }

    public function toggleCommentForm(): void
    {
        $this->showCommentForm = !$this->showCommentForm;
        $this->replyTo = null;
    }

    public function replyToComment($commentId): void
    {
        $this->replyTo = $commentId;
        $this->showCommentForm = true;
    }

    public function submitComment()
    {
        if (!Auth::check()) {
            return redirect()->route('filament.admin.auth.login');
        }

        $this->validate();

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'parent_id' => $this->replyTo,
            'content' => $this->comment,
            'status' => 'approved', // Auto-approve for now
        ]);

        $this->comment = '';
        $this->replyTo = null;
        $this->showCommentForm = false;

        session()->flash('message', 'Comentário adicionado com sucesso!');
    }

    public function render()
    {
        $comments = $this->post->comments()
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->latest()
            ->paginate(10);

        $relatedPosts = Post::published()
            ->where('id', '!=', $this->post->id)
            ->where('category_id', $this->post->category_id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('livewire.post-show', compact('comments', 'relatedPosts'))
            ->title($this->post->title . ' - Blog');
    }
}
