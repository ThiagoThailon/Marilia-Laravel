<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Bem vindo">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center bg-[#FDFDFC]  text-[#1b1b18] lg:justify-center  bg-sky-900"
    >
        <header
            class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl"
        >
            <nav class="flex items-center justify-end gap-4 p-6  ">
                
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
        <main>

            <section class="text-white flex  justify-center items-center ">
                    
                    <Link
                        href="/"
                    >
                        <img  class="h-70 w-70" src="/img/Brasão_de_Marília.png" alt="logomarilia">
                    </Link>
                    <div>
                        <h1 class="text-center text-4xl font-bold text-white" >Sistema de Suporte ao Cidadão</h1>
                        <h2 class="text-xl">Registre solicitações, acompanhe solicitações.</h2>
                    </div>

            </section >
            <section class=" w-full flex flex-col p-10 gap-5">
                
                <h2 class="text-3xl text-white">Como Funciona?</h2>
                
                <article class="bg-slate-50 flex gap-5 rounded-xl  ">

                
                    <div class="flex items-center justify-center w-16 
                                bg-gradient-to-b from-blue-500 to-blue-700
                                text-white text-3xl font-bold
                                rounded-l-xl rounded-tl-xl  rounded-br-[70px] ">
                        1
                    </div>
                    <div class="py-4 pr-4">
                        <h2 class="text-xl font-semibold">Crie uma conta</h2>
                        <p class="text-slate-600 text-sm">
                        Acesse o nosso site com a conta criada.
                        </p>
                    </div>

                </article>
                <article class="bg-slate-50 flex gap-5 rounded-xl  ">

                
                    <div class="flex items-center justify-center w-16 
                                bg-gradient-to-b from-blue-500 to-blue-700
                                text-white text-3xl font-bold
                                rounded-l-xl rounded-tl-xl  rounded-br-[70px] ">
                        2
                    </div>

                    <div class="py-4 pr-4">
                        <h2 class="text-xl font-semibold">Crie um chamado</h2>
                        <p class="text-slate-600 text-sm">
                        Descreva o seu problema ou solicitação e nós envie.
                        </p>
                    </div>

                </article>
                <article class="bg-slate-50 flex gap-5 rounded-xl  ">

                
                    <div class="flex items-center justify-center w-16 
                                bg-gradient-to-b from-blue-500 to-blue-700
                                text-white text-3xl font-bold
                                rounded-l-xl rounded-tl-xl  rounded-br-[70px] ">
                        3
                    </div>

                    <div class="py-4 pr-4">
                        <h2 class="text-xl font-semibold">Acompanhe seu protocolo</h2>
                        <p class="text-slate-600 text-sm">
                        Consulte o status do seu chamado a qualquer momento.
                        </p>
                    </div>

                </article>
                <article class="bg-slate-50 flex gap-5 rounded-xl  ">

                
                    <div class="flex items-center justify-center w-16 
                                bg-gradient-to-b from-blue-500 to-blue-700
                                text-white text-3xl font-bold
                                rounded-l-xl rounded-tl-xl  rounded-br-[70px] ">
                        4
                    </div>

                    <div class="py-4 pr-4">
                        <h2 class="text-xl font-semibold">A prefeitura responde</h2>
                        <p class="text-slate-600 text-sm">
                        Nossa equipe irá analiser e responder sua solicitação o mais breve possível.
                        </p>
                    </div>

                </article>


                
               
                
                
            </section>
           
        </main>
        
        </div>
        
        <footer 
            class=" w-full border-t border-[#00000033] bg-sky-900 text-center p-4
            ">
                <p class="text-xs text-slate-50"
                >Todos os direitos reservados - Prefeitura de Marília&copy;</p>
        </footer>
       
    </div>
</template>
