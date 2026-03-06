<script setup lang="ts">
import TicketList from '@/components/ChamadosUser.vue'
import TicketForm from '@/components/Formulario.vue'
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { getInitials } from '@/composables/useInitials';
import { Link } from '@inertiajs/vue3'

defineProps<{
    tickets?: {
        data: any[],
        links: any[]
    }
}>()

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>

    <main class="min-h-screen w-full flex flex-col bg-slate-50 relative">
        
        <!-- Menu de Usuário Independente -->
        <div class="absolute top-5 right-5 z-10">
            <DropdownMenu>
                <DropdownMenuTrigger class="cursor-pointer outline-none">
                    <Avatar class="h-10 w-10 border border-gray-200 shadow-sm">
                        <AvatarImage v-if="user.avatar" :src="user.avatar" :alt="user.name" />
                        <AvatarFallback>{{ getInitials(user.name) }}</AvatarFallback>
                    </Avatar>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end" class="w-56">
                    <UserMenuContent :user="user" />
                </DropdownMenuContent>
            </DropdownMenu>
        </div>
     
        <div class="h-full w-full flex flex-col justify-center items-center mt-10 flex-1">
            <div class="text-center flex flex-col items-center mb-5">
                <img class="h-30 w-30" src="/img/Brasão_de_Marília.png" alt="logomarilia">
                <p class="text-xl font-semibold">Sistema de Suporte ao Cidadão</p>
                <p>Registre solicitações, acompanhe solicitações.</p>
            </div>
            <TicketForm />
            
            <div class="text-black flex items-end justify-center m-5">
                
                <Link href="/tickets/chamados" class="rounded-xl bg-green-600 px-4 py-3 font-semibold text-white transition hover:bg-green-700 disabled:cursor-not-allowed disabled:opacity-50">

                    Ver Chamados Abertos

                </Link>
                
            </div>
        </div>
        
        <footer class="mt-auto">
            <div class="w-full border-t border-[#00000033] bg-sky-950 p-5 text-center">
                <p class="text-xs text-slate-50">
                    Prefeitura de Marília © - Todos os direitos reservados
                </p>
            </div>
        </footer>
    </main>
</template>