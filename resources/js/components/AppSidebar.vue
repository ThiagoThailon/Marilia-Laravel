<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Head, usePage } from '@inertiajs/vue3';

import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, MessageSquarePlus } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { computed } from 'vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
];


const footerNavItems: NavItem[] = [
     
        {
            title: 'Chamados',
            href: '/tickets/index',
            icon: MessageSquarePlus,
        },
        
        {
           title: 'Criar Chamado User',
            href: '/tickets/create',
            icon: MessageSquarePlus, 

        }
    
];


const footerNav: NavItem[] = [
     
       
        
        {
           title: 'Chamados',
            href: '/tickets/user',
            icon: MessageSquarePlus, 

        }
    
];


const page = usePage();
const userRole = computed(() => (page.props as any).auth?.user?.role ?? null);
const isUser = computed(() => userRole.value === 'user');
const isAdmin = computed(() => userRole.value === 'admin');


</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
                <NavFooter  v-if="isAdmin" :items="footerNavItems"   />

                <NavFooter  v-if="isUser" :items="footerNav"   />
              
            
                <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
