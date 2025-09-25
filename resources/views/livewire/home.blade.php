@push('styles')
<style>
.home_featured {
    background-image: url('https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home-featured.jpg');
}

.home_featured::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;center center;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    z-index: 1;
}

.home_featured_app::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 50%;
    background: #fff;
    z-index: -1;
}
</style>
@endpush

<div>
     <!--FEATURED-->
    <article class="relative text-white m-0 bg-center bg-cover min-h-screen md:min-h-screen sm:min-h-[80vh] home_featured">
        <!-- Overlay -->


        <div class="relative z-[2] pt-20 md:pt-20 sm:pt-15 pb-10 block m-auto" style="width: 1200px; max-width: 90%">
            <header class="m-auto max-w-full text-center" style="width: 660px;">
                <h1 class="text-5xl md:text-5xl sm:text-4xl font-bold mb-7" style="text-shadow: 0 1px 1px rgba(0, 0, 0, .8);">
                    Contas a pagar e receber? Comece a controlar!
                </h1>
                <p class="mt-7 mb-12 text-xl font-normal">
                    Cadastre-se, lance suas contas e conte com automações poderosas para gerenciar tudo enquanto você
                    toma um bom café!
                </p>
                <p>
                    <a title="Cadastre-se"
                       href="{{ route('filament.admin.auth.register') }}"
                       class="inline-block py-5 px-10 cursor-pointer shadow decoration-0 mt-5 text-lg text-white border-0 rounded font-black hover:opacity-90 transition-opacity"
                       style="background: linear-gradient(to right,#42E695 0%,#3BB2B8 50%,#42E695 100%);">
                        Criar minha conta e começar a controlar
                    </a>
                </p>
                <p class="text-sm tracking-tight mt-7 mb-12 font-normal">Rápido | Simples | Gratuito</p>
            </header>
        </div>

        <div class="relative z-[10] -mt-12 text-center block m-auto pb-0 home_featured_app" style="text-align: -webkit-center">
            <img class="max-w-[80%] md:max-w-[80%] sm:max-w-[95%] h-auto block mx-auto"
                 src="https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home-app.jpg"
                 alt="CafeControl"
                 title="CafeControl"/>
        </div>
    </article>

    <!--FEATURES-->
    <div class="bg-white">
        <section class="py-14 m-auto" style="width: 1200px; max-width: 90%">
            <header class="text-center mt-5 mb-10 text-gray-600">
                <h2 class="text-3xl font-medium mb-6 text-gray-800">O que você pode fazer com o CafeControl?</h2>
                <p class="mt-6 text-lg">São 3 passos simples para você começar a controlar suas contas. É tudo muito fácil, veja:</p>
            </header>

            <div class="flex flex-wrap -mx-2">
                <article class="basis-1/3 text-center mx-2 p-8"
                         style="flex-basis: calc(33.33% - 16px); text-align: -webkit-center">
                    <header>
                        <img alt="Contas a receber" title="Contas a receber"
                             src="https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home_receive.jpg"
                             class="mb-5"
                             style="width: 60%;"/>
                        <h3 class="mt-5 mb-2.5 font-medium text-xl text-gray-800">Contas a receber</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Cadastre seus recebíveis, use as automações para salários, contratos e recorrentes e comece a
                            controlar tudo que entra em sua conta. É rápido!
                        </p>
                    </header>
                </article>

                <article class="basis-1/3 text-center mx-2 p-8"
                         style="flex-basis: calc(33.33% - 16px); text-align: -webkit-center">
                    <header>
                        <img alt="Contas a pagar" title="Contas a pagar"
                             src="https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home_pay.jpg"
                             class="mb-5"
                             style="width: 60%;"/>
                        <h3 class="mt-5 mb-2.5 font-medium text-xl text-gray-800">Contas a pagar</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Cadastre suas contas a pagar, despesas, use as automações para contas fixas e parcelamentos e
                            controle tudo que sai de sua conta. É simples!
                        </p>
                    </header>
                </article>

                <article class="basis-1/3 text-center mx-2 p-8"
                         style="flex-basis: calc(33.33% - 16px); text-align: -webkit-center">
                    <header>
                        <img alt="Controle e relatórios" title="Controle e relatórios"
                             src="https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home_control.jpg"
                             class="mb-5"
                             style="width: 60%;"/>
                        <h3 class="mt-5 mb-2.5 font-medium text-xl text-gray-800">Controle e relatórios</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Contas e recebíveis cadastrados? Pronto, agora você tem tudo controlado enquanto toma um bom café
                            e acompanha os relatórios. É gratuito!
                        </p>
                    </header>
                </article>
            </div>
        </section>
    </div>

    <!--OPTIN-->
    <article class="bg-gray-50">
        <div class="m-auto flex flex-wrap items-start text-gray-600 py-14" style="width: 1200px; max-width: 90%">
            <header class="basis-1/2 p-5 pr-10">
                <h2 class="mt-2.5 text-3xl font-bold text-gray-800 leading-tight">
                    Cadastre-se no CaféControl e comece a controlar suas contas hoje mesmo
                </h2>
                <p class="mt-7 text-lg leading-relaxed">
                    Receber e pagar é uma tarefa comum do dia a dia, o CafeControl é um gerenciador de contas simples,
                    fácil e gratuito para ajudar você nessa tarefa.
                </p>
                <p class="mt-7 text-lg leading-relaxed">
                    Com ele você lança suas contas, cria recorrências e conta com automações e relatórios poderosos que
                    controlam tudo enquanto você toma um bom café.
                </p>
                <p class="mt-7 text-lg font-medium text-gray-800">
                    Pronto para começar a controlar?
                </p>
            </header>

            <div class="basis-1/2 p-5 pl-10">
                <h4 class="text-lg font-medium text-gray-800 mb-5">Crie sua conta gratuitamente:</h4>
                <form action="{{ route('filament.admin.auth.register') }}" method="get" class="space-y-4">
                    <input type="text" name="first_name" placeholder="Primeiro nome:"
                           class="w-full p-4 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-colors"/>
                    <input type="text" name="last_name" placeholder="Último nome:"
                           class="w-full p-4 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-colors"/>
                    <input type="email" name="email" placeholder="Melhor e-mail:"
                           class="w-full p-4 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-colors"/>
                    <input type="password" name="password" placeholder="Senha de acesso:"
                           class="w-full p-4 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-colors"/>
                    <button type="submit"
                            class="w-full py-5 px-10 cursor-pointer shadow-lg text-lg text-white border-0 rounded-lg font-black hover:opacity-90 transition-opacity"
                            style="background: linear-gradient(to right,#42E695 0%,#3BB2B8 50%,#42E695 100%);">
                        Criar minha conta
                    </button>
                </form>
            </div>
        </div>
    </article>

    <!--BLOG-->
    <section class="bg-white">
        <div class="py-14 m-auto" style="width: 1200px; max-width: 90%">
            <header class="text-center mb-12 text-gray-600">
                <h2 class="text-3xl font-medium text-gray-800 mb-4">Nossos artigos</h2>
                <p class="text-lg">Confira nossas dicas para controlar melhor suas contas</p>
            </header>

            <div class="flex flex-wrap -mx-5">
                <article class="text-center mx-5 text-gray-600 mb-10" style="flex-basis: calc(33.33% - 40px)">
                    <a title="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                       href="https://www.cafecontrol.com.br/blog/crie-um-instalador-de-estrutura-do-banco-de-dados-para-o-seu-cms-utilizando-php-e-ajax"
                       class="block mb-5 hover:opacity-90 transition-opacity">
                        <img class="rounded-lg shadow-md w-full"
                             title="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                             alt="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                             src="https://www.cafecontrol.com.br/storage/images/cache/crie-um-instalador-de-estrutura-do-banco-de-dados-para-o-seu-cms-utilizando-php-e-ajax-1533220470-600x340-0d2edff0.png"/>
                    </a>
                    <header class="text-left">
                        <p class="mb-3 text-sm text-gray-500">
                            <a title="Artigos em Contas" href="https://www.cafecontrol.com.br/blog/em/contas"
                               class="text-green-600 hover:text-green-700">Contas</a>
                            <span class="mx-2">•</span> Por Robson Leite <span class="mx-2">•</span> 06/02/2019 17h31
                        </p>
                        <h3 class="text-lg font-medium text-gray-800 mb-3 leading-tight">
                            <a title="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                               href="https://www.cafecontrol.com.br/blog/crie-um-instalador-de-estrutura-do-banco-de-dados-para-o-seu-cms-utilizando-php-e-ajax"
                               class="hover:text-green-600 transition-colors">
                                Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            <a title="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                               href="https://www.cafecontrol.com.br/blog/crie-um-instalador-de-estrutura-do-banco-de-dados-para-o-seu-cms-utilizando-php-e-ajax"
                               class="hover:text-green-600 transition-colors">
                                Se você tem um CMS próprio onde disponibiliza a instalação para seus clientes, você tem que assistir essa aula onde te...
                            </a>
                        </p>
                    </header>
                </article>

                <article class="text-center mx-5 text-gray-600 mb-10" style="flex-basis: calc(33.33% - 40px)">
                    <a title="Desenvolvendo Login Step by Step com Ajax e PHP"
                       href="https://www.cafecontrol.com.br/blog/desenvolvendo-login-step-by-step-com-ajax-e-php"
                       class="block mb-5 hover:opacity-90 transition-opacity">
                        <img class="rounded-lg shadow-md w-full"
                             title="Desenvolvendo Login Step by Step com Ajax e PHP"
                             alt="Desenvolvendo Login Step by Step com Ajax e PHP"
                             src="https://www.cafecontrol.com.br/storage/images/cache/desenvolvendo-login-step-by-step-com-ajax-e-php-1532027880-600x340-46a645a0.jpg"/>
                    </a>
                    <header class="text-left">
                        <p class="mb-3 text-sm text-gray-500">
                            <a title="Artigos em Finanças" href="https://www.cafecontrol.com.br/blog/em/financas"
                               class="text-green-600 hover:text-green-700">Finanças</a>
                            <span class="mx-2">•</span> Por Reginaldo José da silva <span class="mx-2">•</span> 20/07/2018 09h59
                        </p>
                        <h3 class="text-lg font-medium text-gray-800 mb-3 leading-tight">
                            <a title="Desenvolvendo Login Step by Step com Ajax e PHP"
                               href="https://www.cafecontrol.com.br/blog/desenvolvendo-login-step-by-step-com-ajax-e-php"
                               class="hover:text-green-600 transition-colors">
                                Desenvolvendo Login Step by Step com Ajax e PHP
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            <a title="Desenvolvendo Login Step by Step com Ajax e PHP"
                               href="https://www.cafecontrol.com.br/blog/desenvolvendo-login-step-by-step-com-ajax-e-php"
                               class="hover:text-green-600 transition-colors">
                                Apresente boas vindas ao usuário antes mesmo de solicitar a senha sem precisar recarregar a página
                            </a>
                        </p>
                    </header>
                </article>

                <article class="text-center mx-5 text-gray-600 mb-10" style="flex-basis: calc(33.33% - 40px)">
                    <a title="Crie um formulário step by step com notificação via SMS"
                       href="https://www.cafecontrol.com.br/blog/criando-um-formulario-step-by-step-com-notificacao-via-sms"
                       class="block mb-5 hover:opacity-90 transition-opacity">
                        <img class="rounded-lg shadow-md w-full"
                             title="Crie um formulário step by step com notificação via SMS"
                             alt="Crie um formulário step by step com notificação via SMS"
                             src="https://www.cafecontrol.com.br/storage/images/cache/criando-um-formulario-step-by-step-com-notificacao-via-sms-1531422721-600x340-d5230b04.jpg"/>
                    </a>
                    <header class="text-left">
                        <p class="mb-3 text-sm text-gray-500">
                            <a title="Artigos em Contas" href="https://www.cafecontrol.com.br/blog/em/contas"
                               class="text-green-600 hover:text-green-700">Contas</a>
                            <span class="mx-2">•</span> Por Reginaldo José da silva <span class="mx-2">•</span> 12/07/2018 15h12
                        </p>
                        <h3 class="text-lg font-medium text-gray-800 mb-3 leading-tight">
                            <a title="Crie um formulário step by step com notificação via SMS"
                               href="https://www.cafecontrol.com.br/blog/criando-um-formulario-step-by-step-com-notificacao-via-sms"
                               class="hover:text-green-600 transition-colors">
                                Crie um formulário step by step com notificação via SMS
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            <a title="Crie um formulário step by step com notificação via SMS"
                               href="https://www.cafecontrol.com.br/blog/criando-um-formulario-step-by-step-com-notificacao-via-sms"
                               class="hover:text-green-600 transition-colors">
                                Veja nessa aula como que você pode criar um formulário de cadastro para autenticar a conta e os dados informados
                            </a>
                        </p>
                    </header>
                </article>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('web.blog') }}"
                   class="inline-block px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                    Ver todos os artigos
                </a>
            </div>
        </div>
    </section>
</div>
