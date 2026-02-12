<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post('/admin', {
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
     Criar Usuario Admin
    </h2>

 
    <div class="flex flex-col gap-1">
        <label for="name" class="font-semibold">
          Name
        </label>

        <input
          id="name"
          type="text"
          v-model="form.name"
          placeholder="Escreva o nome"
          maxlength="40"
          required
          class="w-full rounded-xl border p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        <span
          v-if="form.errors.name"
          class="text-sm text-red-600"
        >
          {{ form.errors.name }}
        </span>
    </div>

 
    <div class="flex flex-col gap-1">
      <label for="email" class="font-semibold">
        Email
      </label>

        
        <input
            id="email"
            type="email"
            v-model="form.email"
            maxlength="50"
            placeholder="Ex: teste@gmail.com"
            required
            class="w-full rounded-xl border p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        

          <span
            v-if="form.errors.email"
            class="text-sm text-red-600"
          >
            {{ form.errors.email }}
          </span>

    </div>
    <div class="flex flex-col gap-1">
      <label for="password" class="font-semibold">
       Senha
      </label>

        
        <input
            id="password"
            type="password"
            v-model="form.password"
            minlength="8"
            placeholder="Digite a senha"
            required
            class="w-full rounded-xl border p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        

          <span
            v-if="form.errors.password"
            class="text-sm text-red-600"
          >
            {{ form.errors.password }}
          </span>

    </div>

    <div class="flex flex-col gap-1">
      <label for="password_confirmation" class="font-semibold">
       Confirmar Senha
      </label>

        
        <input
            id="password_confirmation"
            type="password"
            v-model="form.password_confirmation"
            minlength="8"
            placeholder="Confirme a senha"
            required
            class="w-full rounded-xl border p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        

          <span
            v-if="form.errors.password_confirmation"
            class="text-sm text-red-600"
          >
            {{ form.errors.password_confirmation }}
          </span>

    </div>

   
    <button
      type="submit"
      :disabled="form.processing"
      class="w-full rounded-xl bg-blue-600 px-4 py-3 font-semibold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
    >
      {{ form.processing ? 'Criando...' : 'Criar usuario' }}
    </button>
  </form>
</template>
``