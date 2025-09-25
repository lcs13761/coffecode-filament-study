<div class="w-full">
    @php
        $alignment = $item['alignment'] ?? 'center';
        $alignmentClasses = [
            'left' => 'text-left float-left mr-6 mb-4 max-w-sm',
            'center' => 'text-center mx-auto mb-6"',
            'right' => 'float-right ml-6 mb-4 max-w-sm',
            'full' => 'w-full mb-6',
        ];

        $imageClasses = [
            'left' => 'max-w-md',
            'center' => 'max-w-2xl mx-auto',
            'right' => 'max-w-md ml-auto',
            'full' => 'w-full',
        ];
    @endphp

    <figure class="{{ $alignmentClasses[$alignment] ?? 'text-center mx-auto' }}">
        <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['alt'] }}"
            class="{{ $imageClasses[$alignment] ?? 'max-w-2xl mx-auto' }} h-auto object-cover rounded-lg shadow-lg">

        @if (!empty($item['caption']))
            <figcaption class="mt-3 text-sm text-gray-600 dark:text-gray-400 italic">
                {{ $item['caption'] }}
            </figcaption>
        @endif
    </figure>

    @foreach ($item['content'] ?? [] as $index => $content)
        @switch($content['type'])
            @case('heading')
                @include('livewire.components.heading', ['item' => $content['data']])
                @break

            @case('paragraph')
                @include('livewire.components.paragraph', ['item' => $content['data']])
                @break
        @endswitch
    @endforeach

    <div class="clear-both"></div>
</div>
