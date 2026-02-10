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
    class="flex w-full max-w-xl flex-col space-y-6 rounded-2xl border border-gray-300  bg-white p-8 text-black shadow-sm"
  >
    <h2 class="text-center text-2xl font-bold">
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
        maxlength="25"
        placeholder="Ex: Esqueci minha senha"
        required
        class="w-full rounded-xl border p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
      />

      <span
        v-if="form.errors.title"
        class="text-sm text-red-600"
      >
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
        maxlength="200"
        rows="5"
        placeholder="EX: Estou sem acesso ao e-mail e ao site..."
        required
        class="h-40 w-full resize-none rounded-xl border p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
      />

      <span
        v-if="form.errors.description"
        class="text-sm text-red-600"
      >
        {{ form.errors.description }}
      </span>
    </div>

   
    <button
      type="submit"
      :disabled="form.processing"
      class="w-full rounded-xl bg-blue-600 px-4 py-3 font-semibold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
    >
      {{ form.processing ? 'Enviando...' : 'Enviar chamado' }}
    </button>
  </form>
</template>
``