<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'
import TicketForm from '@/components/Formulario.vue'
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    
];

  
    
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div>

                 <main class="min-h-[50vh] flex items-center justify-center bg-white p-10 rounded-xl border border-sidebar-border0 shadow-sm md:min-h-min dark:bg-sidebar-secondary dark:border-sidebar-border">
                    <TicketForm />
                </main>

            </div>
            <div
                class=" min-h-[50vh] flex-1 rounded-xl border border-sidebar-border0 md:min-h-min dark:border-sidebar-border bg-white text-black"
            >
                <Link href="/tickets/my-tickets" >
                    Ver chamados
                </Link>
            s
            </div>
            

        </div>
    </AppLayout>
</template>
