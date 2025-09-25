<div class="mt-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($item['images'] as $image)
            <div
                class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <img src="{{ Storage::url($image) }}"
                     class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 cursor-pointer"
{{--                     onclick="openLightbox('{{ Storage::url($image) }}')"--}}
                >

                <!-- Overlay -->
{{--                <div--}}
{{--                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">--}}
{{--                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"--}}
{{--                         fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>--}}
{{--                    </svg>--}}
{{--                </div>--}}
            </div>
        @endforeach
    </div>
</div>

<!-- Lightbox JavaScript -->
<script>
    // function openLightbox(src) {
    //     const lightbox = document.getElementById('lightbox');
    //     const image = document.getElementById('lightbox-image');
    //     const captionEl = document.getElementById('lightbox-caption');
    //
    //     image.src = src;
    //
    //     lightbox.classList.remove('hidden');
    //     lightbox.classList.add('flex');
    //     document.body.style.overflow = 'hidden';
    // }
    //
    // function closeLightbox() {
    //     const lightbox = document.getElementById('lightbox');
    //     lightbox.classList.add('hidden');
    //     lightbox.classList.remove('flex');
    //     document.body.style.overflow = 'auto';
    // }
    //
    // // Close lightbox when clicking outside the image
    // document.addEventListener('DOMContentLoaded', () => {
    //     const lightbox = document.getElementById('lightbox');
    //
    //     if (lightbox) {
    //         lightbox.addEventListener('click', function(e) {
    //             if (e.target === this) {
    //                 closeLightbox();
    //             }
    //         });
    //     }
    // });
    //
    //
    // // Close lightbox with ESC key
    // document.addEventListener('DOMContentLoaded', () => {
    //     document.addEventListener('keydown', (e) => {
    //         if (e.key === 'Escape') {
    //             closeLightbox();
    //         }
    //     });
    // });


</script>
