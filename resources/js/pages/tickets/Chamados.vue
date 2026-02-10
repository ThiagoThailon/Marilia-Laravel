<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const enviar = useForm({
  status: 'Fechado',
})

const submit = (ticket) => {
  enviar.put(`/tickets/${ticket.id}/close`)
}

defineProps({
  tickets: {
    type: Object,
    required: true
  }
})
</script>


<template>
  <main class="min-h-screen flex flex-col items-center bg-sky-900  text-black p-6">
    <h1 class="text-2xl font-bold mb-6 text-slate-50">Chamados</h1>

    <div class="bg-neutral-primary-soft shadow-xs rounded-base border border-default w-full max-w-6xl bg-slate-50  rounded-xl overflow-x-auto">
      <table class="w-full text-sm text-center ">
        <thead class="text- text-body bg-neutral-secondary-soft  rounded-base border-default bg-accent/20 border-b h-20">
          <tr>
            <th class="px-6 py-3">Criado Por</th>
            <th class="px-6 py-3">Motivo do Chamado</th>
            <th class="px-6 py-3 ">Descrição</th>
            <th class="px-6 py-3">Criado Em</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Ação</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="ticket in tickets.data"
            :key="ticket.id"
            class="bg-neutral-primary border-b border-default"
          >
            <td class="px-6 py-4 font-medium">
              {{ ticket.user.name }}
            </td>

            <td class="px-6 py-4">
              {{ ticket.title }}
            </td>

           <td class="px-6 py-4 max-w-sm">
            <p class="line-clamp-5 break-words">
              {{ ticket.description }}
            </p>
          </td>

            <td class="px-6 py-4">
              {{ ticket.created_at }}
            </td>

            <td
              class="px-6 py-4"
              :class="ticket.status === 'Aberto'
                ? 'text-green-500'
                : 'text-red-500'"
            >
              {{ ticket.status }}
            </td>

            <td class="px-6 py-4">
              <button
                v-if="ticket.status === 'Aberto'"
                @click="submit(ticket)"
                class="bg-red-600 text-slate-50 px-4 py-2 rounded"
              >
                Fechar Chamado
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="flex gap-1 mt-6">
      <Link
        v-for="link in tickets.links"
        :key="link.label"
        :href="link.url || '#'"
        v-html="link.label"
        preserve-scroll
        class="px-3 py-1 border border-black rounded text-sm"
        :class="[
          link.active
            ? 'bg-blue-600 text-white'
            : 'bg-white text-gray-700 hover:bg-gray-100',
          !link.url && 'opacity-50 pointer-events-none'
        ]"
      />
      
    </div>

    <div class="mt-6">
      <Link href="/dashboard" class="text-white hover:underline">
        Voltar para o Dashboard
      </Link>
    </div>
  </main>
  <footer 
  class=" border-t border-[#00000033] bg-sky-900 text-center p-4
  ">
      <p class="text-xs text-slate-50"
      >Todos os direitos reservados - Prefeitura de Marília&copy;</p>
  </footer>
</template>
