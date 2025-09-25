<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class BlogPage extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $selectedTag = '';
    public $sortBy = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'selectedTag' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatingSelectedTag()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->selectedTag = '';
        $this->sortBy = 'latest';
        $this->resetPage();
    }

    public function selectTag($tagId)
    {
        $this->selectedTag = $tagId;
        $this->resetPage();
    }

    public function render()
    {
        $query = Post::with(['user', 'category', 'tags', 'media'])
            ->where('status', 'published')
            ->where('published_at', '<=', now());

        // Aplicar filtros
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->selectedTag) {
            $query->whereHas('tags', function ($q) {
                $q->where('tags.id', $this->selectedTag);
            });
        }

        // Aplicar ordenação
        switch ($this->sortBy) {
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->orderBy('published_at', 'desc');
        }

        $posts = $query->paginate(12);
        $categories = Category::withCount('posts')->orderBy('name')->get();
        $tags = Tag::withCount('posts')->orderBy('name')->get();
        $popularTags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        $featuredPosts = Post::with(['user', 'category', 'media'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('views_count', 'desc')
            ->take(3)
            ->get();

        return view('livewire.blog-page', compact('posts', 'categories', 'tags', 'popularTags', 'featuredPosts'))->layout('components.layouts.app');
    }
}
