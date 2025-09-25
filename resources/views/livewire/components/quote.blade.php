<div class="my-8">
    <blockquote class="relative bg-gradient-to-r from-gray-50 to-gray-100 border-l-4 border-cafe-500 p-6 rounded-r-lg shadow-sm">
        <!-- Quote Icon -->
        <div class="absolute top-4 left-4 text-cafe-500 opacity-20">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/>
            </svg>
        </div>

        <!-- Quote Content -->
        <div class="relative z-10">
            @if(isset($item['content']) && !empty($item['content']))
                <p class="text-lg md:text-xl text-gray-700 font-medium leading-relaxed italic mb-4 pl-8">
                    "{{ $item['content'] }}"
                </p>
            @endif

            <!-- Author and Source -->
            @if(isset($item['author']) && !empty($item['author']))
                <footer class="flex items-center justify-end">
                    <div class="text-right">
                        <cite class="text-gray-600 font-semibold not-italic">
                            — {{ $item['author'] }}
                        </cite>
                        @if(isset($item['source']) && !empty($item['source']))
                            <div class="text-sm text-gray-500 mt-1">
                                {{ $item['source'] }}
                            </div>
                        @endif
                    </div>
                </footer>
            @endif
        </div>

        <!-- Decorative Quote Mark -->
        <div class="absolute bottom-4 right-4 text-cafe-500 opacity-10 transform rotate-180">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/>
            </svg>
        </div>
    </blockquote>
</div>
