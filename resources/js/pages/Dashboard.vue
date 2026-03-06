<script setup lang="ts">
import { computed } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import TicketForm from '@/components/Formulario.vue'
import TicketList from '@/components/ChamadosUser.vue'
import QuantidadeCard from '@/components/QuantidadeC.vue'
import PainelAdmin from '@/components/FormularioAdmin.vue'

const props = defineProps<{
  tickets?: { // <-- adicione a interrogação aqui
    data: any[],
    links: any[],
    meta?: any
  },
  filters?: { mine?: boolean },
  openTickets?: number,
  closedTickets?: number,
  totalTickets?: number
}>()




const page = usePage();
const userRole = computed(() => (page.props as any).auth?.user?.role ?? null);
const isUser = computed(() => userRole.value === 'user');
const isAdmin = computed(() => userRole.value === 'admin');

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    
];

</script>

<template>
    <Head/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4 bg-sky-800"
        >
            <div>
                
                 <main v-if="isUser"


                 class="min-h-[50vh] flex items-center justify-center bg-white p-10 rounded-xl border border-sidebar-border0 shadow-sm md:min-h-min dark:bg-sidebar-secondary dark:border-sidebar-border">
                    <TicketForm />


                </main>

            </div>
            <div
                class=" min-h-[50vh] flex-1 rounded-xl border border-sidebar-border0 md:min-h-min dark:border-sidebar-border bg-white text-black"
            >
                
                  <div v-if="isAdmin" class=" flex justify-center p-10"> 
                      
                      
                       <PainelAdmin />
                      
                  </div>

                <div v-if="isUser"
                class="p-3">
                    <h1 class="p-2 text-2xl text-center font-semibold">Meus Chamados</h1>
                    <TicketList :tickets="tickets?.data ?? []" :links="tickets?.links ?? []" />
                </div>

                <div v-if="isAdmin">
                    <QuantidadeCard 
                        class="p-3" 
                        :openTickets="openTickets ?? 0" 
                        :closedTickets="closedTickets ?? 0" 
                        :totalTickets="totalTickets ?? 0" 
                    />
                </div>

                
            </div>
            

        </div>
    </AppLayout>
</template>
