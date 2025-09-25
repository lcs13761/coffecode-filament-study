<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostObserver
{
    public function creating(Post $post): void
    {
        // Só limpa se o conteúdo mudou
        if (empty($post->slug)) {
            $post->slug = Str::slug($post->title);
        }

        if (empty($post->reading_time)) {
            $post->reading_time = $post->calculateReadingTime();
        }
    }

    /**
     * Handle the Post "updating" event.
     */
    public function updating(Post $post): void
    {
        // Só limpa se o conteúdo mudou
        if ($post->isDirty('title') && empty($post->slug)) {
            $post->slug = Str::slug($post->title);
        }

        if ($post->isDirty('content')) {
            $post->reading_time = $post->calculateReadingTime();
            $post->cleanupUnusedImages($post->content);
        }
    }

    /**
     * Handle the Post "deleting" event.
     */
    public function deleting(Post $post): void
    {
        // Remove todas as imagens quando o post é deletado
        $this->deleteAllPostImages($post);
    }

    /**
     * Remove todas as imagens do post
     */
    private function deleteAllPostImages(Post $post): void
    {
        $images = $post->extractImagesFromContent($post->content ?? []);

        foreach ($images as $imagePath) {
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        // Remove também outras imagens (featured, gallery, attachments)
        $otherImages = array_filter([
            $post->featured_image,
            ...$post->gallery ?? [],
            ...$post->attachments ?? []
        ]);

        foreach ($otherImages as $imagePath) {
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
    }
}
