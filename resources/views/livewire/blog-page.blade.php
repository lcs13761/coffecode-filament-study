<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="relative text-white bg-gray-900">
        <!-- Gradiente café igual ao da home -->
        <div class="absolute inset-0"
            style="background: linear-gradient(to right, #42E695 0%, #3BB2B8 50%, #42E695 100%); opacity: 0.9;"></div>

        <div class="container mx-auto px-4 py-16 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Nosso <span class="text-yellow-200">Blog</span>
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-8 leading-relaxed">
                    Confira nossas dicas para controlar melhor suas contas e finanças
                </p>
            </div>
        </div>
    </section>

    <!-- Featured Posts -->
    @if ($featuredPosts->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Artigos em Destaque</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach ($featuredPosts as $post)
                        <article class="group cursor-pointer">
                            <a href="{{ route('web.blog.post', $post->slug) }}" wire:navigate>
                                <div
                                    class="relative overflow-hidden rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300">
                                    @if ($post->getFirstMediaUrl('featured_image'))
                                        <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                                            alt="{{ $post->title }}"
                                            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div
                                            class="w-full h-64 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white opacity-50" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="bg-blue-600 px-2 py-1 rounded-full text-xs font-medium">
                                                {{ $post->category->name }}
                                            </span>
                                            <span class="text-xs opacity-75">{{ $post->views_count }}
                                                visualizações</span>
                                        </div>
                                        <h3 class="text-xl font-bold mb-2 line-clamp-2">{{ $post->title }}</h3>
                                        <p class="text-sm opacity-90 line-clamp-2">{{ $post->excerpt }}</p>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Filters and Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap lg:flex-nowrap gap-8">

                <!-- Sidebar -->
                <aside class="w-full lg:w-80 space-y-8">
                    <!-- Filters -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Filtros</h3>

                        <!-- Search Bar -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pesquisar</label>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                placeholder="Pesquisar artigos..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Sort -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ordenar por</label>
                            <select wire:model.live="sortBy"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="latest">Mais recentes</option>
                                <option value="oldest">Mais antigos</option>
                                <option value="popular">Mais populares</option>
                                <option value="title">Título (A-Z)</option>
                            </select>
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Categorias</label>
                            <select wire:model.live="selectedCategory"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Todas as categorias</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }} ({{ $category->posts_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tags -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                            <select wire:model.live="selectedTag"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Todas as tags</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">
                                        {{ $tag->name }} ({{ $tag->posts_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Clear Filters -->
                        @if ($search || $selectedCategory || $selectedTag || $sortBy !== 'latest')
                            <button wire:click="clearFilters"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors">
                                Limpar Filtros
                            </button>
                        @endif
                    </div>

                    <!-- Popular Tags -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Tags Populares</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($popularTags as $tag)
                                <button wire:click="selectTag({{ $tag->id }})"
                                    class="bg-blue-100 hover:bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm transition-colors cursor-pointer
                                    {{ $selectedTag == $tag->id ? 'bg-blue-600 text-white' : '' }}">
                                    {{ $tag->name }}
                                    <span class="text-xs opacity-75">({{ $tag->posts_count }})</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Artigos Recentes</h3>
                        <div class="space-y-4">
                            @foreach ($featuredPosts->take(5) as $post)
                                <div class="flex space-x-3">
                                    @if ($post->getFirstMediaUrl('featured_image'))
                                        <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                                            alt="{{ $post->title }}"
                                            class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                                    @else
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white opacity-50" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">
                                            <a href="{{ route('web.blog.post', $post->slug) }}" wire:navigate
                                                class="hover:text-blue-600">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-500">{{ $post->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="flex-1">
                    <!-- Results Info -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-gray-900">
                                @if ($search)
                                    Resultados para "{{ $search }}"
                                @elseif($selectedCategory)
                                    {{ $categories->find($selectedCategory)->name ?? 'Categoria' }}
                                @elseif($selectedTag)
                                    {{ $tags->find($selectedTag)->name ?? 'Tag' }}
                                @else
                                    Todos os Artigos
                                @endif
                            </h2>
                            <span class="text-gray-600">{{ $posts->total() }} artigos encontrados</span>
                        </div>

                        <!-- Active Filters -->
                        @if ($search || $selectedCategory || $selectedTag)
                            <div class="mt-4 flex flex-wrap gap-2">
                                @if ($search)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                        Busca: "{{ $search }}"
                                        <button wire:click="$set('search', '')"
                                            class="ml-2 text-blue-600 hover:text-blue-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </span>
                                @endif

                                @if ($selectedCategory)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                                        Categoria: {{ $categories->find($selectedCategory)->name }}
                                        <button wire:click="$set('selectedCategory', '')"
                                            class="ml-2 text-green-600 hover:text-green-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </span>
                                @endif

                                @if ($selectedTag)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-800">
                                        Tag: {{ $tags->find($selectedTag)->name }}
                                        <button wire:click="$set('selectedTag', '')"
                                            class="ml-2 text-purple-600 hover:text-purple-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Posts Grid -->
                    <div class="grid md:grid-cols-2 gap-8">
                        @forelse($posts as $post)
                            <article
                                class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                                <a href="{{ route('web.blog.post', $post->slug) }}" class="block" wire:navigate>
                                    @if ($post->getFirstMediaUrl('featured_image'))
                                        <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                                            alt="{{ $post->title }}"
                                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div
                                            class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-white opacity-50" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </a>

                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span
                                            class="bg-{{ $post->category->color ?? 'blue' }}-600 text-white px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $post->category->name }}
                                        </span>
                                        <div class="flex items-center space-x-2 text-xs text-gray-500">
                                            <span>{{ $post->published_at->format('d/m/Y') }}</span>
                                            <span>•</span>
                                            <span>{{ $post->views_count }} views</span>
                                        </div>
                                    </div>

                                    <h2
                                        class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                                        <a href="{{ route('web.blog.post', $post->slug) }}" wire:navigate>
                                            {{ $post->title }}
                                        </a>
                                    </h2>

                                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $post->excerpt }}</p>

                                    <!-- Tags -->
                                    @if ($post->tags->count() > 0)
                                        <div class="flex flex-wrap gap-1 mb-4">
                                            @foreach ($post->tags->take(3) as $tag)
                                                <button wire:click="selectTag({{ $tag->id }})"
                                                    class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-600 px-2 py-1 rounded transition-colors">
                                                    #{{ $tag->name }}
                                                </button>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-medium text-gray-600">
                                                    {{ substr($post->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <span class="text-sm text-gray-600">{{ $post->user->name }}</span>
                                        </div>
                                        <a href="{{ route('web.blog.post', $post->slug) }}" wire:navigate
                                            class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            Ler mais →
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-2 text-center py-12">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                                <h3 class="text-xl font-medium text-gray-900 mb-2">Nenhum artigo encontrado</h3>
                                <p class="text-gray-600">Tente ajustar seus filtros ou pesquisar novamente.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>
                </main>
            </div>
        </div>
    </section>
</div>
