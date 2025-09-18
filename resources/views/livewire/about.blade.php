@section('title', 'Sobre')

<div class="py-12">
    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <header class="text-center w-3/4 mx-auto mb-10">
                <h1 class="text-3xl">É simples, fácil e gratuito!</h1>
                <p class="mt-5">Com o CaféControl você controla suas contas a pagar e receber e conta com
                    automações e relatórios poderosos para controlar tudo enquanto toma um bom café.</p>
            </header>

            <!--FEATURES-->
            <div class="flex flex-wrap justify-center">
                <article class="m-5 p-7 text-center" style="flex-basis: calc(33.33% - 40px)">
                    <header>
                        <span class=""></span>
                        <h3 class="mt-5 text-lg">Cadastre-se para começar</h3>
                        <p class="mt-3.5">Basta informar seus dados e confirmar seu cadastro para começar a
                            usar
                            GRATUITAMENTE os
                            recursos
                            do CaféControl.</p>
                    </header>
                </article>

                <article class="m-5 p-7 text-center" style="flex-basis: calc(33.33% - 40px)">
                    <header>
                        <span class=""></span>
                        <h3 class="mt-5 text-lg">Lance suas contas</h3>
                        <p class="mt-3.5">Cadastre suas despesas, contas a pagar e receber, recebíveis e
                            recorrentes em uma interface simples e muito intuitiva.</p>
                    </header>
                </article>

                <article class="m-5 p-7 text-center" style="flex-basis: calc(33.33% - 40px)">
                    <header>
                        <span class=""></span>
                        <h3 class="mt-5 text-lg">Obtenha o controle</h3>
                        <p class="mt-3.5">As automações do CaféControl se encarregam de gerar todos os dados
                            necessários
                            para você
                            obter
                            controle simplificado.</p>
                    </header>
                </article>
            </div>
        </div>

        <div class="about_page_media bg-transparent relative">
            <div class="mx-auto shadow rounded-lg overflow-hidden" style="width: 860px;max-width: 90%">
                <div class="relative overflow-hidden max-w-full h-0" style="padding-bottom: 56.25%">
                    <iframe width="560" height="315" class="absolute top-0 left-0 w-full h-full"
                            src=https://www.youtube.com/embed/lDZGl9Wdc7Y?rel=0&showinfo=0"
                            frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <aside class="text-center"
               style="background-size: 200%; background: linear-gradient(to right,#42E695 0%,#3BB2B8 50%,#42E695 100%)">
            <div class="py-16 max-w-full m-auto" style="width: 600px;">
                <h2 class="text-2xl font-bold">Ainda não está usando o CaféControl?</h2>
                <p class="my-5">Com ele você tem todos os recursos necessários para controlar suas contas. Crie
                    sua conta
                    e comece a
                    agora! É simples, fácil e gratuito...</p>
                <a title="Cadastre-se"
                   class="inline-block py-5 px-10 cursor-pointer shadow decoration-0 mt-5 text-lg text-white border-0 rounded font-black"
                   style="background: linear-gradient(to right,#42E695 0%,#3BB2B8 50%,#42E695 100%);">Quero
                    controlar</a>
            </div>
        </aside>
    </section>
</div>

@section('page-style')

    <style>

        .about_page_media {
            background-color: rgb(243 244 246 / 0) !important;
        }

        .about_page_media:after {
            content: "" !important;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60%;
            background: linear-gradient(to right, #42E695 0%, #3BB2B8 50%, #42E695 100%) !important;
            background-size: 200%;
            z-index: -1 !important;

        }
    </style>
@endsection
