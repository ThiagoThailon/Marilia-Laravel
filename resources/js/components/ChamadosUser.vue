
<script setup >

import { Link } from '@inertiajs/vue3'
import { useFormatDate } from '@/composables/useFormatDate'

const { formatDate } = useFormatDate()

const props = defineProps({
  tickets: {
    type: Array,
    required: true
  },
  links: {
    type: Array,
    default: () => []
  }
})



</script>


        <template>
            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-black">
                <table class="w-full text-sm text-left rtl:text-right text-body bg">
                    <thead class="text- text-body bg-neutral-secondary-soft  rounded-base border-default bg-accent/10 border-b text-black font-semibold">
                        <tr class="">
                           
                            <th scope="col" class="px-6 py-3 font-medium">Motivo do Chamado</th>
                            <th scope="col" class="px-6 py-3 font-medium">Descrição</th>
                            <th scope="col" class="px-6 py-3 font-medium">Criado Em</th>
                            <th scope="col" class="px-6 py-3 font-medium">Status</th>
                            <th scope="col" class="px-6 py-3 font-medium">Contagem</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        <tr
                        v-for="ticket in tickets"
                        :key="ticket.id" 
                        class="bg-neutral-primary border-b border-default">
                            
                            <td class=" px-6 py-4 max-w-lg truncate ">{{ ticket.title }}</td>
                            <td class="px-6 py-4">{{ ticket.description }}</td>
                            <td class="px-6 py-4">{{ formatDate(ticket.created_at) }}</td>
                            <td class="px-6 py-4"
                            :class= "ticket.status === 'Aberto'
                                ? 'text-green-500'
                                : 'text-red-500'"
                            >{{ ticket.status }}</td>

                           <td class="px-6 py-4">{{ closedCount }}</td>
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
                    ? 'bg-blue-600 text-white border-blue-600'   
                    : 'bg-white text-gray-700 hover:bg-gray-100',
                !link.url && 'opacity-50 pointer-events-none'
                ]"
            />
                
            </div>
      </template>