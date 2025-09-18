@section('page-style')
    <style>
        .home_featured:after {
            content: "";
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: absolute;
            z-index: -1;
            background: url('https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home-featured.jpg') no-repeat fixed top center;
            background-size: cover;
        }

        .container {
            display: block;
            width: 1200px;
            max-width: 90%;
            margin: 0 auto;
        }

        .home_featured_app:after {
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
@endsection


<div>
    <!--FEATURED-->
    <article class="relative text-white m-0 home_featured" style="background: rgba(0, 0, 0, .5);">
        <div class="pt-20 block m-auto" style="width: 1200px; max-width: 90%">
            <header class="m-auto max-w-full text-center" style="width: 660px;">
                <h1 class="text-5xl font-bold" style="text-shadow: 0 1px 1px rgba(0, 0, 0, .8);">
                    Contas a pagar e receber? Comece a controlar!
                </h1>
                <p class="mt-7 mb-12 text-xl font-normal">
                    Cadastre-se, lance suas contas e conte com automações poderosas para gerenciar tudo enquanto você
                    toma um bom café!
                </p>
                <p>
                    <a title="Cadastre-se"
                       class="inline-block py-5 px-10 cursor-pointer shadow decoration-0 mt-5 text-lg text-white border-0 rounded font-black"
                       style="background: linear-gradient(to right,#42E695 0%,#3BB2B8 50%,#42E695 100%);">Criar
                        minha conta e começar a controlar</a>
                </p>
                <p class="text-sm tracking-tight mt-7 mb-12 font-normal">Rápido | Simples | Gratuito</p>
            </header>
        </div>

        <div class="text-center block m-auto relative z-10 home_featured_app" style="text-align: -webkit-center">
            <img style="max-width: 90%" src="https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home-app.jpg"
                 alt="CafeControl"
                 title="CafeControl"/>
        </div>
    </article>

    <!--FEATURES-->
    <div class="">
        <section class="py-14 m-auto" style="width: 1200px; max-width: 90%">
            <header class="text-center mt-5 mb-10 text-[#555]">
                <h2 class="text-2xl  font-medium">O que você pode fazer com o CafeControl?</h2>
                <p class="mt-6">São 3 passos simples para você começar a controlar suas contas. É tudo muito fácil,
                    veja:</p>
            </header>

            <div class="flex">
                <article class="basis-1/3 text-center m-2 p-8"
                         style="border-top: 3px solid #fff;text-align: -webkit-center">
                    <header>
                        <img alt="Contas a receber" title="Contas a receber"
                             src="https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home_receive.jpg"
                             style="width: 60%;"/>
                        <h3 class="mt-5 mb-2.5 font-medium text-xl">Contas a receber</h3>
                        <p class="text-sm">Cadastre seus recebíveis, use as automações para salários, contratos e
                            recorrentes e comece a
                            controlar tudo que entra em sua conta. É rápido!</p>
                    </header>
                </article>

                <article class="basis-1/3 text-center m-2 p-8"
                         style="border-top: 3px solid #fff;text-align: -webkit-center">
                    <header>
                        <img alt="Contas a pagar" title="Contas a pagar"
                             src="https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home_pay.jpg"
                             style="width: 60%;"/>
                        <h3 class="mt-5 mb-2.5 font-medium text-xl">Contas a pagar</h3>
                        <p class="text-sm">Cadastre suas contas a pagar, despesas, use as automações para contas fixas e
                            parcelamentos e
                            controle tudo que sai de sua conta. É simples!</p>
                    </header>
                </article>

                <article class="basis-1/3 text-center m-2 p-8"
                         style="border-top: 3px solid #fff;text-align: -webkit-center">
                    <header>
                        <img alt="Controle e relatórios" title="Controle e relatórios" style="width: 60%;"
                             src="https://www.cafecontrol.com.br/themes/cafeweb/assets/images/home_control.jpg"/>
                        <h3 class="mt-5 mb-2.5 font-medium text-xl">Controle e relatórios</h3>
                        <p class="text-sm">Contas e recebíveis cadastrados? Pronto, agora você tem tudo controlado
                            enquanto toma um bom
                            café
                            e acompanha os relatórios. É gratuito!</p>
                    </header>
                </article>
            </div>
        </section>
    </div>

    <!--OPTIN-->
    <article class="bg-[#FBFBFB]">
        <div class="m-auto flex items-start text-[#555] py-14" style="width: 1200px; max-width: 90%">
            <header class="basis-1/2 p-5">
                <h2 class="mt-2.5 text-3xl font-bold">Cadastre-se no CaféControl e comece a controlar suas contas hoje
                    mesmo</h2>
                <p class="mt-7 text-lg">Receber e pagar é uma tarefa comum do dia a dia, o CafeControl é um gerenciador de
                    contas simples,
                    fácil
                    e gratuito para ajudar você nessa tarefa.</p>
                <p class="mt-7 text-lg">Com ele você lança suas contas, cria recorrências e conta com atuomações e relatórios
                    poderosos que
                    controlam tudo enquanto você toma um bom café.</p>
                <p class="mt-7 text-lg">Pronto para começar a controlar?</p>
            </header>

            <div class="basis-1/2">
                <h4>Crie sua conta gratuitamente:</h4>
                <form action="https://www.cafecontrol.com.br/cadastrar" method="post" enctype="multipart/form-data">
                    <div class="ajax_response"></div>
                    <input type="text" name="first_name" placeholder="Primeiro nome:"
                           class="w-full mb-3.5 p-3.5 rounded"/>
                    <input type="text" name="last_name" placeholder="Último nome:" class="w-full mb-3.5 p-3.5 rounded"/>
                    <input type="email" name="email" placeholder="Melhor e-mail:" class="w-full mb-3.5 p-3.5 rounded"/>
                    <input type="password" name="password" placeholder="Senha de acesso:"
                           class="w-full mb-3.5 p-3.5 rounded"/>
                    <button
                        class="w-full inline-block py-5 px-10 cursor-pointer shadow decoration-0 text-lg text-white border-0 rounded font-black"
                        style="background: linear-gradient(to right,#42E695 0%,#3BB2B8 50%,#42E695 100%);">Criar minha
                        conta
                    </button>
                </form>
            </div>
        </div>
    </article>

    <!--BLOG-->
    <section>
        <div class="container py-14">
            <header class="text-center mb-6 text-[#555]">
                <h2 class="text-3xl">Nossos artigos</h2>
                <p class="mt-2.5">Confira nossas dicas para controlar melhor suas contas</p>
            </header>

            <div class="flex flex-wrap">
                <article class="text-center m-5 text-[#555]" style="flex-basis: calc(33.33% - 40px)">
                    <a title="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                       href="https://www.cafecontrol.com.br/blog/crie-um-instalador-de-estrutura-do-banco-de-dados-para-o-seu-cms-utilizando-php-e-ajax">
                        <img class="rounded-md"
                             title="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                             alt="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                             src="https://www.cafecontrol.com.br/storage/images/cache/crie-um-instalador-de-estrutura-do-banco-de-dados-para-o-seu-cms-utilizando-php-e-ajax-1533220470-600x340-0d2edff0.png"/>
                    </a>
                    <header>
                        <p class="my-5">
                            <a title="Artigos em Contas"
                               href="https://www.cafecontrol.com.br/blog/em/contas">Contas</a>
                            &bull; Por Robson Leite &bull; 06/02/2019 17h31 </p>
                        <h2>
                            <a title="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                               href="https://www.cafecontrol.com.br/blog/crie-um-instalador-de-estrutura-do-banco-de-dados-para-o-seu-cms-utilizando-php-e-ajax">Crie
                                um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX</a>
                        </h2>
                        <p>
                            <a title="Crie um instalador de estrutura do banco de dados para o seu CMS utilizando PHP e AJAX"
                               href="https://www.cafecontrol.com.br/blog/crie-um-instalador-de-estrutura-do-banco-de-dados-para-o-seu-cms-utilizando-php-e-ajax">
                                Se você tem um CMS próprio onde disponibiliza a instalação para seus clientes, você tem
                                que assistir essa aula onde te...</a></p>
                    </header>
                </article>
                <article class="basis-1/3 text-center m-5 text-[#555]" style="flex-basis: calc(33.33% - 40px)">
                    <a title="Desenvolvendo Login Step by Step com Ajax e PHP"
                       href="https://www.cafecontrol.com.br/blog/desenvolvendo-login-step-by-step-com-ajax-e-php">
                        <img class="rounded-md" title="Desenvolvendo Login Step by Step com Ajax e PHP"
                             alt="Desenvolvendo Login Step by Step com Ajax e PHP"
                             src="https://www.cafecontrol.com.br/storage/images/cache/desenvolvendo-login-step-by-step-com-ajax-e-php-1532027880-600x340-46a645a0.jpg"/>
                    </a>
                    <header>
                        <p class="my-5">
                            <a title="Artigos em Finanças"
                               href="https://www.cafecontrol.com.br/blog/em/financas">Finanças</a>
                            &bull; Por Reginaldo José da silva &bull; 20/07/2018 09h59 </p>
                        <h2><a title="Desenvolvendo Login Step by Step com Ajax e PHP"
                               href="https://www.cafecontrol.com.br/blog/desenvolvendo-login-step-by-step-com-ajax-e-php">Desenvolvendo
                                Login Step by Step com Ajax e PHP</a></h2>
                        <p><a title="Desenvolvendo Login Step by Step com Ajax e PHP"
                              href="https://www.cafecontrol.com.br/blog/desenvolvendo-login-step-by-step-com-ajax-e-php">
                                Apresente boas vindas ao usuário antes mesmo de solicitar a senha sem precisar
                                recarregar a página</a></p>
                    </header>
                </article>
                <article class="basis-1/3 text-center m-5 text-[#555]" style="flex-basis: calc(33.33% - 40px)">
                    <a title="Crie um formulário step by step com notificação via SMS"
                       href="https://www.cafecontrol.com.br/blog/criando-um-formulario-step-by-step-com-notificacao-via-sms">
                        <img class="rounded-md" title="Crie um formulário step by step com notificação via SMS"
                             alt="Crie um formulário step by step com notificação via SMS"
                             src="https://www.cafecontrol.com.br/storage/images/cache/criando-um-formulario-step-by-step-com-notificacao-via-sms-1531422721-600x340-d5230b04.jpg"/>
                    </a>
                    <header>
                        <p class="my-5">
                            <a title="Artigos em Contas"
                               href="https://www.cafecontrol.com.br/blog/em/contas">Contas</a>
                            &bull; Por Reginaldo José da silva &bull; 12/07/2018 15h12 </p>
                        <h2><a title="Crie um formulário step by step com notificação via SMS"
                               href="https://www.cafecontrol.com.br/blog/criando-um-formulario-step-by-step-com-notificacao-via-sms">Crie
                                um formulário step by step com notificação via SMS</a></h2>
                        <p><a title="Crie um formulário step by step com notificação via SMS"
                              href="https://www.cafecontrol.com.br/blog/criando-um-formulario-step-by-step-com-notificacao-via-sms">
                                Veja nessa aula como que você pode criar um formulário de cadastro para autenticar a
                                conta e os dados informados</a></p>
                    </header>
                </article>
            </div>
        </div>
    </section>
</div>
