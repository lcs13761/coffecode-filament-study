<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\PostObserver;

#[ObservedBy([PostObserver::class])]
class Post extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'published_at',
        'meta_data',
        'views_count',
        'reading_time',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'content' => 'array',
        'gallery' => 'array',
        'meta_data' => 'array',
        'views_count' => 'integer',
        'reading_time' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('status', 'approved');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('status', 'scheduled')
                    ->where('published_at', '>', now());
    }

    public function getIsPublishedAttribute(): bool
    {
        return $this->status === 'published' && $this->published_at <= now();
    }

    public function getCommentsCountAttribute(): int
    {
        return $this->approvedComments()->count();
    }

    public function calculateReadingTime(): int
    {
        $text = '';
        $content = $this->content;
        if (is_array($content)) {
            foreach ($content as $block) {
                $type = $block['type'] ?? null;
                $data = $block['data'] ?? [];
                if ($type === 'heading') {
                    $text .= ' ' . ($data['content'] ?? '');
                } elseif ($type === 'paragraph') {
                    $text .= ' ' . ($data['content'] ?? '');
                } elseif ($type === 'image') {
                    $text .= ' ' . ($data['alt'] ?? '');
                }
            }
        } else {
            $text = (string) $content;
        }
        $wordCount = str_word_count(strip_tags($text));
        return max(1, ceil($wordCount / 200)); // 200 palavras por minuto
    }

    public function getContentHtmlAttribute(): string
    {
        $content = $this->content;
        if (! is_array($content)) {
            return (string) $content;
        }

        $html = '';
        foreach ($content as $block) {
            $type = $block['type'] ?? null;
            $data = $block['data'] ?? [];

            switch ($type) {
                case 'heading':
                    $level = $data['level'] ?? 'h2';
                    $level = in_array($level, ['h1','h2','h3','h4','h5','h6']) ? $level : 'h2';
                    $html .= sprintf('<%1$s>%2$s</%1$s>', $level, e($data['content'] ?? ''));
                    break;

                case 'paragraph':
                    $html .= sprintf('<p>%s</p>', nl2br(e($data['content'] ?? '')));
                    break;

                case 'image':
                    $alt = e($data['alt'] ?? '');
                    $src = null;
                    $mediaRef = $data['media'] ?? null;

                    if ($mediaRef) {
                        $mediaId = is_array($mediaRef) ? ($mediaRef[0] ?? null) : $mediaRef;
                        if ($mediaId) {
                            $media = $this->media()
                                ->where('collection_name', 'content')
                                ->where(function ($q) use ($mediaId) {
                                    $q->where('uuid', $mediaId)->orWhere('id', $mediaId);
                                })
                                ->first();
                            if ($media) {
                                $src = $media->getUrl();
                            }
                        }
                    }

                    if (! $src && isset($data['url'])) {
                        $src = $data['url'];
                    }

                    if ($src) {
                        $html .= sprintf('<figure><img src="%s" alt="%s" /><figcaption>%s</figcaption></figure>', e($src), $alt, $alt);
                    }
                    break;
            }
        }

        return $html;
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Remove imagens antigas que não estão mais sendo usadas
     */
    public function cleanupUnusedImages(array $newContent): void
    {
        $oldContent = $this->getOriginal('content') ?? [];
        $oldImages = $this->extractImagesFromContent($oldContent);
        $newImages = $this->extractImagesFromContent($newContent);

        $imagesToDelete = array_diff($oldImages, $newImages);

        foreach ($imagesToDelete as $imagePath) {
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
    }

    /**
     * Extrai todos os caminhos de imagens do conteúdo
     */
    public function extractImagesFromContent(array $content): array
    {
        $images = [];

        foreach ($content as $block) {
            switch ($block['type']) {
                case 'image':
                case 'image_text':
                    if (!empty($block['data']['image'])) {
                        $images[] = $block['data']['image'];
                    }
                    break;

                case 'gallery':
                    if (!empty($block['data']['images'])) {
                        $images = array_merge($images, $block['data']['images']);
                    }
                    break;

                case 'video':
                    if (!empty($block['data']['thumbnail'])) {
                        $images[] = $block['data']['thumbnail'];
                    }
                    break;
            }
        }

        return $images;
    }
}
