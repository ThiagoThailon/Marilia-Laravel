<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';
import { Transition } from 'vue';   

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
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#fafafa] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Abrir Chamado
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#fafafa] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Acessar
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#fafafa] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Registrar
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="flex flex-col w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
            <main class="p-10 m-10">

                <section class="text-white flex  justify-center items-center ">
                        
                        <Link
                            href="/"
                        >
                            <img  class="h-70 w-70 transition-transform duration-300 hover:-translate-y-3" src="/img/Brasão_de_Marília.png" alt="logomarilia" 
                            >
                        </Link>
                        <div>
                            <h1 class="text-center text-4xl font-bold text-white" >Sistema de Suporte ao Cidadão</h1>
                            <h2 class="text-xl">Registre solicitações, acompanhe solicitações.</h2>
                        </div>
                        
                        
                </section >
            </main>
            <section class=" w-full flex flex-row p-10  bg-slate-50 justify-center items-center gap-10">
                <div class="flex flex-col gap-9 bg-slate-50 justify-between items-center ">
                    
                    <h2 class="text-3xl text-left font-semibold text-sky-900">Como Funciona?</h2>
                    
                    <article class="bg-white w-200 flex gap-5 rounded-xl border border-white shadow-xl transition-transform duration-300 hover:-translate-y-3">
                    
                        <div class="flex items-center justify-center w-16
                                    bg-linear-to-b from-blue-500 to-blue-700
                                    text-white text-3xl font-bold
                                    rounded-l-xl rounded-tl-xl  rounded-br-[70px] ">
                            1
                        </div>
                        <div class="py-4 pr-4 ">
                            <h2 class="text-xl font-semibold text-sky-900">Crie uma conta</h2>
                            <p class="text-slate-600 text-sm">
                            Acesse o nosso site com a conta criada.
                            </p>
                        </div>
                    </article>
                    <article class="bg-white w-200 flex gap-5 rounded-xl border border-white shadow-xl transition-transform duration-300 hover:-translate-y-3 ">
                    
                        <div class="flex items-center justify-center w-16
                                    bg-linear-to-b from-blue-500 to-blue-700
                                    text-white text-3xl font-bold
                                    rounded-l-xl rounded-tl-xl  rounded-br-[70px] ">
                            2
                        </div>
                        <div class="py-4 pr-4">
                            <h2 class="text-xl font-semibold text-sky-900">Crie um chamado</h2>
                            <p class="text-slate-600 text-sm">
                            Descreva o seu problema ou solicitação e nos envie.
                            </p>
                        </div>
                    </article>
                    <article class="bg-white w-200 flex gap-5 rounded-xl border border-white shadow-xl transition-transform duration-300 hover:-translate-y-3 ">
                    
                        <div class="flex items-center justify-center w-16
                                    bg-linear-to-b from-blue-500 to-blue-700
                                    text-white text-3xl font-bold
                                    rounded-l-xl rounded-tl-xl  rounded-br-[70px] ">
                            3
                        </div>
                        <div class="py-4 pr-4">
                            <h2 class="text-xl font-semibold text-sky-900">Acompanhe seu protocolo</h2>
                            <p class="text-slate-600 text-sm">
                            Consulte o status do seu chamado a qualquer momento.
                            </p>
                        </div>
                    </article>
                    <article class="bg-white w-200 flex gap-5 rounded-xl border border-white shadow-xl transition-transform duration-300 hover:-translate-y-3 ">
                    
                        <div class="flex items-center justify-center w-16
                                    bg-linear-to-b from-blue-500 to-blue-700
                                    text-white text-3xl font-bold
                                    rounded-l-xl rounded-tl-xl  rounded-br-[70px] ">
                            4
                        </div>
                        <div class="py-4 pr-4">
                            <h2 class="text-xl font-semibold text-sky-900">A prefeitura responde</h2>
                            <p class="text-slate-600 text-sm">
                            Nossa equipe irá analisar e responder sua solicitação o mais breve possível.
                            </p>
                        </div>
                    </article>
                </div>    
                <div>
                    <img
                    class="h-150 w-200 relative top-15 "
                     src="/img/person.png" alt="pessoa">
                </div>

                
               
                
                
            </section>
           
        
        
        </div>
        
    <footer class="w-full border-t border-[#00000033] bg-sky-900">

        <div class="flex justify-center items-center">
            <div class="flex items-center justify-around p-10  max-w-6xl w-full">

                <div class="flex items-center gap-4">
                    <img class="h-20 w-20 " src="/img/Brasão_de_Marília.png" alt="logomarilia">
                    <h3 class="text-white text-xl font-bold">
                        Prefeitura de Marília
                    </h3>
                </div>

                <div class="flex flex-col text-white text-left">
                    <p>Rua: Bahia, nº 40 - Centro - CEP: 17501-900</p>
                    <p>(14) 3402-6000</p>
                    <p>Atendimento de Segunda-feira a Sexta-feira das 08 às 17 horas</p>

                    <div class="flex items-center gap-5 mt-2">
                        <a href="https://www.facebook.com/PrefeituraMarilia/" target="_blank">
                            <img class="h-9 w-9 transition-transform duration-300 hover:-translate-y-2" src="/img/facebook.png" alt="Facebook">
                        </a>
                        <a href="https://www.instagram.com/prefeiturademarilia/" target="_blank">
                            <img class="h-8 w-8 transition-transform duration-300 hover:-translate-y-2" src="/img/instagram.png" alt="Instagram">
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="w-full border-t border-[#00000033] bg-sky-950 p-5 text-center">
            <p class="text-xs text-slate-50">
                Prefeitura de Marília © - Todos os direitos reservados
            </p>
        </div>

    </footer>

       
    </div>
</template>
