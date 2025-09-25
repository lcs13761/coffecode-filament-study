<nav class="bg-white/95 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="container-custom">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('web.home') }}" class="flex items-center space-x-3 group">
                    <div
                        class="w-10 h-10 bg-gradient-cafe rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M2,21H20V19H2M20,8H18V5H20M20,3H4V13A4,4 0 0,0 8,17H14A4,4 0 0,0 18,13V10H20A2,2 0 0,0 22,8V5C22,3.89 21.1,3 20,3Z" />
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-xl font-bold text-gray-800 group-hover:text-cafe-600 transition-colors">
                            CaféControl
                        </h1>
                        <p class="text-xs text-gray-500 -mt-1">Controle suas contas</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('web.home') }}" wire:navigate
                    class="nav-link {{ request()->routeIs('web.home') ? 'active' : '' }}">
                    Home
                </a>
                <a href="{{ route('web.about') }}"
                    class="nav-link {{ request()->routeIs('web.about') ? 'active' : '' }}" wire:navigate>
                    Sobre
                </a>
                <a href="{{ route('web.blog') }}" wire:navigate
                    class="nav-link {{ request()->routeIs('web.blog') ? 'active' : '' }}">
                    Blog
                </a>

                <!-- CTA Button -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('filament.admin.auth.login') }}"
                        class="text-gray-600 hover:text-cafe-600 font-medium transition-colors duration-200">
                        Entrar
                    </a>
                    <a href="#" class="btn-primary-sm">
                        Criar conta
                    </a>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-btn" onclick="toggleMobileMenu()">
                    <span class="sr-only">Abrir menu</span>
                    <svg class="menu-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="close-icon w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu hidden md:hidden border-t border-gray-200 bg-white">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('web.home') }}"
                    class="mobile-nav-link {{ request()->routeIs('web.home') ? 'active' : '' }}">
                    Home
                </a>
                <a href="{{ route('web.about') }}"
                    class="mobile-nav-link {{ request()->routeIs('web.about') ? 'active' : '' }}" wire:navigate>
                    Sobre
                </a>
                <a href="{{ route('web.blog') }}"
                    class="mobile-nav-link {{ request()->routeIs('web.blog') ? 'active' : '' }}">
                    Blog
                </a>

                <div class="pt-4 border-t border-gray-200 space-y-2">
                    <a href="{{ route('filament.admin.auth.login') }}"
                        class="block px-3 py-2 text-gray-600 hover:text-cafe-600 font-medium transition-colors">
                        Entrar
                    </a>
                    <a href="#" class="block w-full text-center btn-primary-sm">
                        Criar conta grátis
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.querySelector('.mobile-menu');
        const menuIcon = document.querySelector('.menu-icon');
        const closeIcon = document.querySelector('.close-icon');

        mobileMenu.classList.toggle('hidden');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const mobileMenu = document.querySelector('.mobile-menu');
        const menuButton = document.querySelector('.mobile-menu-btn');

        if (!mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            document.querySelector('.menu-icon').classList.remove('hidden');
            document.querySelector('.close-icon').classList.add('hidden');
        }
    });
</script>
