<footer class="bg-gray-900 text-white">
    <!-- Main Footer Content -->
    <div class="container-custom py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About Section -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-cafe rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2,21H20V19H2M20,8H18V5H20M20,3H4V13A4,4 0 0,0 8,17H14A4,4 0 0,0 18,13V10H20A2,2 0 0,0 22,8V5C22,3.89 21.1,3 20,3Z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold">CaféControl</h2>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed">
                    O CaféControl é um gerenciador de contas simples, poderoso e gratuito.
                    O prazer de tomar um café e ter o controle total de suas contas.
                </p>
                <div class="pt-2">
                    <a href="#"
                       class="text-sm text-gray-400 hover:text-cafe-400 transition-colors duration-200">
                        Termos de uso
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-white border-b border-gray-700 pb-2">
                    Navegação
                </h3>
                <nav class="space-y-3">
                    <a href="{{ route('web.home') }}"
                       class="footer-link">
                        Home
                    </a>
                    <a href="{{ route('web.about') }}"
                       class="footer-link"
                       wire:navigate>
                        Sobre
                    </a>
                    <a href="{{ route('web.blog') }}"
                       class="footer-link">
                        Blog
                    </a>
                    <a href="{{ route('filament.admin.auth.login') }}"
                       class="footer-link">
                        Entrar
                    </a>
                </nav>
            </div>

            <!-- Contact Info -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-white border-b border-gray-700 pb-2">
                    Contato
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-cafe-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-300">
                                <span class="font-medium">Telefone:</span><br>
                                +55 55 5555.5555
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-cafe-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-300">
                                <span class="font-medium">Email:</span><br>
                                cafe@cafecontrol.com
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-cafe-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-300">
                                <span class="font-medium">Endereço:</span><br>
                                Florianópolis, SC/Brasil
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-white border-b border-gray-700 pb-2">
                    Redes Sociais
                </h3>
                <div class="space-y-3">
                    <a href="https://www.facebook.com/"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="social-link group">
                        <svg class="w-5 h-5 text-cafe-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span>/CafeControl</span>
                    </a>

                    <a href="https://www.instagram.com/"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="social-link group">
                        <svg class="w-5 h-5 text-cafe-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.297-3.323C5.902 8.198 7.053 7.708 8.35 7.708s2.448.49 3.323 1.297c.897.875 1.387 2.026 1.387 3.323s-.49 2.448-1.297 3.323c-.875.897-2.026 1.387-3.323 1.387zm7.718 0c-1.297 0-2.448-.49-3.323-1.297-.897-.875-1.387-2.026-1.387-3.323s.49-2.448 1.297-3.323c.875-.897 2.026-1.387 3.323-1.387s2.448.49 3.323 1.297c.897.875 1.387 2.026 1.387 3.323s-.49 2.448-1.297 3.323c-.875.897-2.026 1.387-3.323 1.387z"/>
                        </svg>
                        <span>@CafeControl</span>
                    </a>

                    <a href="https://www.youtube.com/"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="social-link group">
                        <svg class="w-5 h-5 text-cafe-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        <span>/CafeControl</span>
                    </a>
                </div>

                <!-- Newsletter Signup -->
                <div class="pt-4">
                    <h4 class="text-sm font-medium text-white mb-3">Newsletter</h4>
                    <form class="space-y-2">
                        <input type="email"
                               placeholder="Seu email"
                               class="w-full px-3 py-2 text-sm bg-gray-800 border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <button type="submit"
                                class="w-full px-3 py-2 text-sm bg-gradient-cafe text-white rounded-md hover:opacity-90 transition-opacity duration-200">
                            Inscrever-se
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="border-t border-gray-800">
        <div class="container-custom py-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-sm text-gray-400">
                    © {{ date('Y') }} CaféControl. Todos os direitos reservados.
                </div>

                <div class="flex items-center space-x-6">
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">
                        Política de Privacidade
                    </a>
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">
                        Termos de Serviço
                    </a>
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors duration-200">
                        Suporte
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
