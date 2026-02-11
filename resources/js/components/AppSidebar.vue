<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';


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
    
    
];



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
                <NavFooter  :items="footerNavItems"   />

           
                <!-- <div 
                    class=" px-2 py-1 rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-800 mt-4">
                    <Link href="tickets/index"
                     class="  dark:text-neutral-300 dark:hover:text-neutral-100">
                    
                        Chamados
                    </Link>
                </div> -->
            
                <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
