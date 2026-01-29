
<script setup>
import { Link, router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

const enviar = useForm({
  status: 'Fechado',
})
const submit = (ticket) => {
  enviar.put(`/tickets/${ticket.id}/close`)
}




defineProps({
  tickets: Array
})
</script>

<template>

  <main class=" min-h-screen flex  bg-white">
      
      
        <div class="text-black flex flex-col w-full   justify-center items-center p-10" >
          <h1 class="mt-10 text-4xl font-semibold">Meus Chamados</h1>
          <section class="bg-slate-100 w-full m-30 rounded-lg flex  p-10 border-2 border-gray-300 flex-wrap ">
              <div v-if="tickets.length === 0">
                <p>Nenhum chamado encontrado.</p>
              </div>
                  <div v-else>

                

                      <div class="mt-10 ticket" v-for="ticket in tickets" :key="ticket.id" >
                          <div class="bg-white m-10 p-5 rounded-lg border-2  border-gray-300 w-full  " >
                              <h3>Motivo do chamado: {{ ticket.title }}</h3>
                              <p>Descrição: {{ ticket.description }}</p>
                              <p>Criador por: {{ ticket.user.name }}</p>
                              <p>Criado em: {{ ticket.created_at }}</p>
                              <p class="font-bold mb-5"
                                  :class="ticket.status === 'Aberto' ? 'text-green-500' : 'text-red-500'"
                                  >
                                  Status: {{ ticket.status }}
                              </p>
                              
                              <div v-if="ticket.status === 'Aberto'">
                                  <button
                                      @click="submit(ticket)"
                                      class="bg-red-600 text-white px-4 py-2 rounded"
                                  >
                                      Fechar Chamado
                                  </button>
                              </div>

                          </div>
                      </div>
                      <div>
                      <Link
                        href="/dashboard"
                        class="text-blue-600 hover:underline"
                      >
                        Voltar para o Dashboard
                      </Link>
                    </div>
                                          
              </div>
          </section>

        </div>
  </main>


</template>