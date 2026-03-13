<script setup lang="js" >

import PainelAdmin from '@/components/FormularioAdmin.vue'
import UserMenuContent from '@/components/UserMenuContent.vue';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { getInitials } from '@/composables/useInitials';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import {  MessageSquarePlus } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3'

const page = usePage();
const user = computed(() => page.props.auth.user);


</script>

<template>
    <main class="min-h-screen flex flex-col items-center bg-sky-800">
        <div class="absolute top-10 right-5 z-10 transition-transform duration-300 hover:-translate-y-2">
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

        <div class="flex flex-col justify-center items-center mt-10 flex-1">
                <PainelAdmin />
        </div>

       <div class="fixed bottom-15 right-6 z-50 transition-transform duration-300 hover:-translate-y-2">
            <Link href="/tickets/index">
                <div class="cursor-pointer flex items-center gap-2 bg-white border border-gray-200 shadow-lg px-4 py-3 rounded-full hover:bg-gray-50">
                    <MessageSquarePlus class="h-5 w-5 text-gray-700" />
                    <span class="text-sm text-gray-700">Chamados</span>
                </div>
            </Link>
        </div>
        <footer class=" w-full border-t border-[#00000033] bg-sky-900 text-center p-4 ">

            <p class="text-xs text-slate-50"
            >Todos os direitos reservados - Prefeitura de Marília&copy;</p>

        </footer>
    </main>
</template>