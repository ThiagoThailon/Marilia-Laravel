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
  <main class="min-h-screen flex flex-col items-center bg-white text-black p-6">
    <h1 class="text-2xl font-bold mb-6">Chamados</h1>

    <div class="bg-neutral-primary-soft shadow-xs rounded-base border border-default w-full max-w-6xl">
      <table class="w-full text-sm text-left">
        <thead class="bg-accent/10 border-b">
          <tr>
            <th class="px-6 py-3">Criado Por</th>
            <th class="px-6 py-3">Motivo do Chamado</th>
            <th class="px-6 py-3">Descrição</th>
            <th class="px-6 py-3">Criado Em</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Ação</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="ticket in tickets.data"
            :key="ticket.id"
            class="border-b hover:bg-neutral-secondary-medium"
          >
            <td class="px-6 py-4 font-medium">
              {{ ticket.user.name }}
            </td>

            <td class="px-6 py-4">
              {{ ticket.title }}
            </td>

            <td class="px-6 py-4">
              {{ ticket.description }}
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
                class="bg-red-600 text-white px-4 py-2 rounded"
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
      <Link href="/dashboard" class="text-blue-600 hover:underline">
        Voltar para o Dashboard
      </Link>
    </div>
  </main>
</template>
