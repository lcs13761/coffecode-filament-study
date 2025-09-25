<div class="clear-both mb-8">
    @if (!empty($item['title']))
        <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $item['title'] }}</h3>
    @endif

    <div class="relative w-full">
        @php
            $videoUrl = $item['url'] ?? '';
            $embedUrl = '';

            // YouTube
            if (str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be')) {
                if (str_contains($videoUrl, 'youtu.be/')) {
                    $videoId = substr($videoUrl, strrpos($videoUrl, '/') + 1);
                } else {
                    parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);
                    $videoId = $query['v'] ?? '';
                }
                $embedUrl = "https://www.youtube.com/embed/{$videoId}";
            }
            // Vimeo
            elseif (str_contains($videoUrl, 'vimeo.com')) {
                $videoId = substr($videoUrl, strrpos($videoUrl, '/') + 1);
                $embedUrl = "https://player.vimeo.com/video/{$videoId}";
            }
        @endphp

        @if ($embedUrl)
            <!-- Video Embed -->
            <div class="relative w-full" style="padding-bottom: 56.25%; height: 0;">
                <iframe src="{{ $embedUrl }}" class="absolute top-0 left-0 w-full h-full rounded-lg shadow-lg"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        @else
            <!-- Fallback para URLs não suportadas -->
            <div class="bg-gray-100 rounded-lg p-8 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                <p class="text-gray-600 mb-4">Vídeo não disponível para incorporação</p>
                <a href="{{ $videoUrl }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                        </path>
                    </svg>
                    Assistir no site original
                </a>
            </div>
        @endif
    </div>

    @if (!empty($item['description']))
        <div class="mt-4 text-gray-600 text-sm leading-relaxed">
            {{ $item['description'] }}
        </div>
    @endif
</div>
