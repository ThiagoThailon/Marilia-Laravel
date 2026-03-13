<script setup lang="js">
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post('/admin/users', {
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
<div class="flex w-full items-center justify-center">

<form
  @submit.prevent="submit"
  class="w-full max-w-xl space-y-6 rounded-2xl border bg-white p-8 shadow-sm"
>

  <!-- Título -->
  <div class="text-center">
    <h2 class="text-2xl font-bold text-gray-800">
      Criar Usuário Administrador
    </h2>

    <p class="mt-1 text-sm text-gray-500">
      Cadastre um novo administrador no sistema
    </p>
  </div>

  <!-- Nome -->
  <div class="space-y-2">
    <label for="name" class="text-sm font-semibold text-gray-700">
      Nome
    </label>

    <input
      id="name"
      type="text"
      v-model="form.name"
      maxlength="40"
      placeholder="Digite o nome completo"
      required
      class="w-full rounded-xl border border-gray-300 p-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
    />

    <p v-if="form.errors.name" class="text-sm text-red-600">
      {{ form.errors.name }}
    </p>
  </div>

  <!-- Email -->
  <div class="space-y-2">
    <label for="email" class="text-sm font-semibold text-gray-700">
      Email
    </label>

    <input
      id="email"
      type="email"
      v-model="form.email"
      maxlength="50"
      placeholder="exemplo@email.com"
      required
      class="w-full rounded-xl border border-gray-300 p-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
    />

    <p v-if="form.errors.email" class="text-sm text-red-600">
      {{ form.errors.email }}
    </p>
  </div>

  <!-- Senhas lado a lado -->
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

    <div class="space-y-2">
      <label for="password" class="text-sm font-semibold text-gray-700">
        Senha
      </label>

      <input
        id="password"
        type="password"
        v-model="form.password"
        minlength="8"
        placeholder="Digite a senha"
        required
        class="w-full rounded-xl border border-gray-300 p-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
      />

      <p v-if="form.errors.password" class="text-sm text-red-600">
        {{ form.errors.password }}
      </p>
    </div>

    <div class="space-y-2">
      <label for="password_confirmation" class="text-sm font-semibold text-gray-700">
        Confirmar Senha
      </label>

      <input
        id="password_confirmation"
        type="password"
        v-model="form.password_confirmation"
        minlength="8"
        placeholder="Confirme a senha"
        required
        class="w-full rounded-xl border border-gray-300 p-3 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
      />

      <p v-if="form.errors.password_confirmation" class="text-sm text-red-600">
        {{ form.errors.password_confirmation }}
      </p>
    </div>

  </div>

  <!-- Botão -->
  <button
    type="submit"
    :disabled="form.processing"
    class="flex w-full items-center justify-center rounded-xl bg-blue-600 px-4 py-3 font-semibold text-white transition hover:bg-blue-700 disabled:opacity-60"
  >
    <span v-if="form.processing" class="animate-pulse">
      Criando usuário...
    </span>

    <span v-else>
      Criar Usuário
    </span>
  </button>

</form>
</div>
</template>