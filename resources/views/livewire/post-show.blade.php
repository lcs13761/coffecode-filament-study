<div>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-20">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="container-custom relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Breadcrumb -->
                <nav class="mb-8">
                    <ol class="flex items-center justify-center space-x-2 text-sm">
                        <li>
                            <a href="{{ route('web.home') }}" class="text-gray-300 hover:text-white transition-colors">
                                Home
                            </a>
                        </li>
                        <li class="text-gray-400">/</li>
                        <li>
                            <a href="{{ route('web.blog') }}" class="text-gray-300 hover:text-white transition-colors">
                                Blog
                            </a>
                        </li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-400">{{ $post->title }}</li>
                    </ol>
                </nav>

                <!-- Category Badge -->
                @if ($post->category)
                    <div class="mb-6">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-cafe-500 text-white">
                            {{ $post->category->name }}
                        </span>
                    </div>
                @endif

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    {{ $post->title }}
                </h1>

                <!-- Subtitle -->
                @if ($post->subtitle)
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        {{ $post->subtitle }}
                    </p>
                @endif

                <!-- Meta Information -->
                <div class="flex flex-wrap items-center justify-center gap-6 text-sm text-gray-300">
                    <!-- Author -->
                    @if ($post->user)
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Por {{ $post->user->name }}</span>
                        </div>
                    @endif

                    <!-- Published Date -->
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $post->published_at->format('d/m/Y') }}</span>
                    </div>

                    <!-- Reading Time -->
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $post->reading_time }} min de leitura</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <article class="bg-white">
        <div class="container-custom py-16">
            <div class="max-w-4xl mx-auto">
                <!-- Featured Image -->
                @if ($post->featured_image_url)
                    <div class="mb-12">
                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}"
                            class="w-full h-96 object-cover rounded-xl shadow-lg">
                    </div>
                @endif

                <!-- Content -->
                <div class="prose prose-lg max-w-none">
                    <div class="text-gray-700 leading-relaxed">
                        @foreach ($post->content as $index => $content)
                            @switch($content['type'])
                                @case('heading')
                                    @include('livewire.components.heading', ['item' => $content['data']])
                                @break

                                @case('paragraph')
                                    @include('livewire.components.paragraph', ['item' => $content['data']])
                                @break

                                @case('image')
                                    @include('livewire.components.image', ['item' => $content['data']])
                                @break

                                @case('gallery')
                                    @include('livewire.components.gallery', ['item' => $content['data']])
                                @break

                                @case('video')
                                    @include('livewire.components.video', ['item' => $content['data']])
                                @break

                                @case('code')
                                    @include('livewire.components.code', ['item' => $content['data']])
                                @break

                                @case('quote')
                                    @include('livewire.components.quote', ['item' => $content['data']])
                                @break
                                @case('separator')
                                    @include('livewire.components.separator', ['item' => $content['data']])
                                    @break
                            @endswitch
                        @endforeach
                    </div>
                </div>

                <!-- Tags -->
                @if ($post->tags->count() > 0)
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tags:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($post->tags as $tag)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Share Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Compartilhar:</h3>
                    <div class="flex space-x-4">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            Facebook
                        </a>

                        <!-- Twitter -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                            Twitter
                        </a>

                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                            LinkedIn
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . request()->url()) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                            </svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- Related Posts Section -->
    @if ($relatedPosts && $relatedPosts->count() > 0)
        <section class="bg-gray-50">
            <div class="container-custom py-16">
                <div class="max-w-6xl mx-auto">
                    <header class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Artigos Relacionados</h2>
                        <p class="text-lg text-gray-600">Continue lendo sobre assuntos similares</p>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($relatedPosts as $relatedPost)
                            <article
                                class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <!-- Image -->
                                @if ($relatedPost->featured_image)
                                    <div class="aspect-w-16 aspect-h-9">
                                        <img src="{{ Storage::url($relatedPost->featured_image) }}"
                                            alt="{{ $relatedPost->title }}" class="w-full h-48 object-cover">
                                    </div>
                                @endif

                                <div class="p-6">
                                    <!-- Category -->
                                    @if ($relatedPost->category)
                                        <div class="mb-3">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-cafe-100 text-cafe-800">
                                                {{ $relatedPost->category->name }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Title -->
                                    <h3 class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2">
                                        <a href="{{ route('web.blog.post', $relatedPost->slug) }}"
                                            class="hover:text-cafe-600 transition-colors">
                                            {{ $relatedPost->title }}
                                        </a>
                                    </h3>

                                    <!-- Excerpt -->
                                    @if ($relatedPost->subtitle)
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                            {{ $relatedPost->subtitle }}
                                        </p>
                                    @endif

                                    <!-- Meta -->
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>{{ $relatedPost->published_at->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{--                                            <span>{{ ceil(str_word_count(strip_tags($relatedPost->content)) / 200) }} --}}
                                            {{--                                                min</span> --}}
                                        </div>
                                    </div>

                                    <!-- Read More Button -->
                                    <div class="mt-4">
                                        <a href="{{ route('web.blog.post', $relatedPost->slug) }}"
                                            class="inline-flex items-center text-cafe-600 hover:text-cafe-700 font-medium text-sm transition-colors">
                                            Ler mais
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- View All Posts Button -->
                    <div class="text-center mt-12">
                        <a href="{{ route('web.blog') }}"
                            class="inline-flex items-center px-8 py-3 bg-cafe-600 text-white rounded-lg hover:bg-cafe-700 transition-colors font-medium">
                            Ver todos os artigos
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
