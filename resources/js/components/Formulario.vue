<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  description: '',
})


const submit = () => {
  form.post('/tickets', {
    preserveScroll: true,
    preserveState: false,
    onSuccess: () => {
      form.reset()
      form.clearErrors()
    },
  })
}

</script>

<template>
  <form
    @submit.prevent="submit"
    class="space-y-6 p-8 flex flex-col border border-gray-300 rounded-2xl w-full max-w-xl text-black bg-white shadow-sm"
  >
    <h2 class="text-2xl font-bold text-center">
      Abrir chamado
    </h2>

    <div class="flex flex-col gap-1">
      <label for="title" class="font-semibold">
        Motivo do chamado
      </label>

      <input
        id="title"
        type="text"
        v-model="form.title"
        placeholder="Ex: Problema no sistema"
        class="border p-3 w-full rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none"
        required
      />

      <span v-if="form.errors.title" class="text-red-600 text-sm">
        {{ form.errors.title }}
      </span>
    </div>

    
    <div class="flex flex-col gap-1">
      <label for="description" class="font-semibold">
        Descrição
      </label>

      <textarea
        id="description"
        v-model="form.description"
        placeholder="Descreva o problema com o máximo de detalhes possível"
        class="border p-3 h-40 w-full rounded-xl resize-none focus:ring-2 focus:ring-blue-500 focus:outline-none"
        required
      />

      <span v-if="form.errors.description" class="text-red-600 text-sm">
        {{ form.errors.description }}
      </span>
    </div>

  
    <button
      type="submit"
      :disabled="form.processing"
      class="bg-blue-600 text-white px-4 py-3 w-full rounded-xl font-semibold
             hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
    >
      {{ form.processing ? 'Enviando...' : 'Enviar chamado' }}
    </button>
  </form>
</template>
