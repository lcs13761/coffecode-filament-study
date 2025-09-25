<div class="clear-both mb-8">
    <div class="relative bg-gray-900 rounded-lg overflow-hidden shadow-lg">
        <!-- Header com linguagem, filename e botão de copiar -->
        <div class="flex items-center justify-between px-4 py-2 bg-gray-800 border-b border-gray-700">
            <div class="flex items-center space-x-3">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>

                @if (!empty($item['filename']))
                    <span class="text-sm font-medium text-gray-300">
                        {{ $item['filename'] }}
                    </span>
                @endif

                @if (!empty($item['language']))
                    <span class="text-xs px-2 py-1 bg-gray-700 text-gray-300 rounded capitalize">
                        {{ $item['language'] }}
                    </span>
                @endif
            </div>

            <button onclick="copyToClipboard(this)" data-code="{{ base64_encode($item['content'] ?? '') }}"
                class="flex items-center space-x-1 px-2 py-1 text-xs text-gray-400 hover:text-white bg-gray-700 hover:bg-gray-600 rounded transition-colors"
                title="Copiar código">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="copy-text">Copiar</span>
            </button>
        </div>

        <!-- Código -->
        <div class="relative">
            <pre class="p-4 text-sm leading-relaxed overflow-x-auto"><code class="language-{{ $item['language'] ?? 'text' }} text-gray-100">{{ $item['content'] ?? '' }}</code></pre>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            function copyToClipboard(button) {
                const code = atob(button.dataset.code);
                const copyText = button.querySelector('.copy-text');

                // Verifica se clipboard API está disponível
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(code).then(function() {
                        copyText.textContent = 'Copiado!';
                        button.classList.add('text-green-400');

                        setTimeout(function() {
                            copyText.textContent = 'Copiar';
                            button.classList.remove('text-green-400');
                        }, 2000);
                    }).catch(function(err) {
                        console.error('Erro ao copiar: ', err);
                        copyText.textContent = 'Erro';
                        setTimeout(function() {
                            copyText.textContent = 'Copiar';
                        }, 2000);
                    });
                } else {
                    // Fallback para navegadores mais antigos ou contextos não seguros
                    const textArea = document.createElement('textarea');
                    textArea.value = code;
                    textArea.style.position = 'fixed';
                    textArea.style.left = '-999999px';
                    textArea.style.top = '-999999px';
                    document.body.appendChild(textArea);
                    textArea.focus();
                    textArea.select();

                    try {
                        document.execCommand('copy');
                        copyText.textContent = 'Copiado!';
                        button.classList.add('text-green-400');

                        setTimeout(function() {
                            copyText.textContent = 'Copiar';
                            button.classList.remove('text-green-400');
                        }, 2000);
                    } catch (err) {
                        console.error('Erro ao copiar: ', err);
                        copyText.textContent = 'Erro';
                        setTimeout(function() {
                            copyText.textContent = 'Copiar';
                        }, 2000);
                    }

                    document.body.removeChild(textArea);
                }
            }
        </script>
    @endpush
@endonce

@once
    @push('styles')
        <style>
            /* Syntax highlighting básico */
            .language-php .token.keyword {
                color: #ff79c6;
            }

            .language-php .token.string {
                color: #f1fa8c;
            }

            .language-php .token.comment {
                color: #6272a4;
                font-style: italic;
            }

            .language-php .token.variable {
                color: #8be9fd;
            }

            .language-php .token.function {
                color: #50fa7b;
            }

            .language-javascript .token.keyword {
                color: #ff79c6;
            }

            .language-javascript .token.string {
                color: #f1fa8c;
            }

            .language-javascript .token.comment {
                color: #6272a4;
                font-style: italic;
            }

            .language-javascript .token.function {
                color: #50fa7b;
            }

            .language-html .token.tag {
                color: #ff79c6;
            }

            .language-html .token.attr-name {
                color: #50fa7b;
            }

            .language-html .token.attr-value {
                color: #f1fa8c;
            }

            .language-css .token.property {
                color: #8be9fd;
            }

            .language-css .token.string {
                color: #f1fa8c;
            }

            .language-css .token.selector {
                color: #50fa7b;
            }

            /* Scrollbar customizada */
            pre::-webkit-scrollbar {
                height: 8px;
            }

            pre::-webkit-scrollbar-track {
                background: #374151;
            }

            pre::-webkit-scrollbar-thumb {
                background: #6b7280;
                border-radius: 4px;
            }

            pre::-webkit-scrollbar-thumb:hover {
                background: #9ca3af;
            }
        </style>
    @endpush
@endonce
