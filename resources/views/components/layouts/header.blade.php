<nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('web.home') }}">
                        <ApplicationLogo
                            class="block h-9 w-auto fill-current text-gray-800"
                        />
                    </a>
                </div>
            </div>

            <div class="items-end self-center">
                <a class="link transition radius" title="Home" href="{{ route('web.home') }}">Home</a>
                <a class="link transition radius" title="Sobre" href="{{ route('web.about') }}"
                   wire:navigate>Sobre</a>
                <a class="link transition radius" title="Blog" href="{{ route('web.blog') }}">Blog</a>
                <!--                        <a class="link transition radius" title="Blog" href="route('blog')">Blog</a>-->
                <a href="{{ route('filament.admin.auth.login') }}">
                    Entrar
                </a>
            </div>


            <!-- Hamburger -->
            <!--                        <div class="-me-2 flex items-center sm:hidden">-->
            <!--                            <button-->
            <!--                                @click="showingNavigationDropdown = !showingNavigationDropdown"-->
            <!--                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"-->
            <!--                            >-->
            <!--                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">-->
            <!--                                    <path-->
            <!--                                        :class="{-->
            <!--                                            hidden: showingNavigationDropdown,-->
            <!--                                            'inline-flex': !showingNavigationDropdown,-->
            <!--                                        }"-->
            <!--                                        stroke-linecap="round"-->
            <!--                                        stroke-linejoin="round"-->
            <!--                                        stroke-width="2"-->
            <!--                                        d="M4 6h16M4 12h16M4 18h16"-->
            <!--                                    />-->
            <!--                                    <path-->
            <!--                                        :class="{-->
            <!--                                            hidden: !showingNavigationDropdown,-->
            <!--                                            'inline-flex': showingNavigationDropdown,-->
            <!--                                        }"-->
            <!--                                        stroke-linecap="round"-->
            <!--                                        stroke-linejoin="round"-->
            <!--                                        stroke-width="2"-->
            <!--                                        d="M6 18L18 6M6 6l12 12"-->
            <!--                                    />-->
            <!--                                </svg>-->
            <!--                            </button>-->
            <!--                        </div>-->
        </div>
    </div>

</nav>
