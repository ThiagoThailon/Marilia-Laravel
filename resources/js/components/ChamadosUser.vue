
<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps<{
  tickets: Array<{
    id: number|string
    user?: { name?: string } | null
    title: string
    description: string
    created_at: string
    status: string
  }>
  links?: Array<{
    url: string | null
    label: string
    active: boolean
  }>
}>()
</script>


        <template>
            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Criado Por</th>
                            <th scope="col" class="px-6 py-3 font-medium">Motivo do Chamado</th>
                            <th scope="col" class="px-6 py-3 font-medium">Descrição</th>
                            <th scope="col" class="px-6 py-3 font-medium">Criado Em</th>
                            <th scope="col" class="px-6 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="ticket in tickets"
                        :key="ticket.id" 
                        class="bg-neutral-primary border-b border-default">
                            <td scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">{{ ticket.user?.name }}</td>
                            <td class="px-6 py-4">{{ ticket.title }}</td>
                            <td class="px-6 py-4">{{ ticket.description }}</td>
                            <td class="px-6 py-4">{{ ticket.created_at }}</td>
                            <td class="px-6 py-4"
                            :class= "ticket.status === 'Aberto'
                                ? 'text-green-500'
                                : 'text-red-500'"
                            >{{ ticket.status }}</td>
                            
                        </tr>
                    </tbody>
                </table>
                
            </div>
           <div class="flex gap-1 mt-6 justify-center">
            <Link
                v-for="link in links"
                :key="link.label"
                :href="link.url || '#'"
                v-html="link.label"
                preserve-scroll
                class="px-3 py-1 rounded text-sm border border-gray-700" 
                :class="[
                link.active
                    ? 'bg-blue-600 text-white border-blue-600'   // mantém borda azul quando ativo
                    : 'bg-white text-gray-700 hover:bg-gray-100',
                !link.url && 'opacity-50 pointer-events-none'
                ]"
            />
                
            </div>
      </template>