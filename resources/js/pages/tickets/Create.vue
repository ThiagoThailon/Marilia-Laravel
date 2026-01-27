 <script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  description: '',
  status: 'open',
})

const submit = () => {
  form.post('/tickets')
}
</script>

<template>
  <form @submit.prevent="submit" class="space-y-4">
    <input
      v-model="form.title"
      type="text"
      placeholder="Título do chamado"
      class="border p-2 w-full"
    >

    
    <textarea
      v-model="form.description"
      placeholder="Descrição"
      class="border p-2 w-full"
    ></textarea>

    <button
      type="submit"
      :disabled="form.processing"
      class="bg-blue-600 text-white px-4 py-2 rounded"
    >
      {{ form.processing ? 'Enviando...' : 'Enviar' }}
    </button>
  </form>
</template>
