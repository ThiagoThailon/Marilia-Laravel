<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  description: '',
  status: 'Aberto',
})
const submit = () => {
  form.post('/tickets')
}
</script>

<template>

        <main class=" min-h-screen flex items-center justify-center   bg-white">


            <section class=" text-black">

                <form @submit.prevent="submit" class="space-y-4 p-10 flex flex-col justify-center items-center border-2 border-gray-300 h-130 w-100 rounded-2xl" >
                    <label for="form.title" class="text-xl font-bold">Motivo do chamado</label>
                    <input type="text" v-model = "form.title" class="border p-2  w-full rounded-xl" />

                    <label for="form.description"  class="text-xl font-bold" >Descrição do problema</label>
                    <textarea v-model = "form.description" class="border  p-2 h-40 w-full rounded-2xl placeholder:Eu esqueci a senha da conta e estou sem acesso ao Email cadastrado" />
                     <button
                    type="submit"
                    :disabled="form.processing"
                    class="bg-blue-600 text-white px-4 py-2 w-full rounded-lg "
                    >
                    {{ form.processing ? 'Enviando...' : 'Enviar' }}
                    </button>
                    <Link
                            href="/dashboard"
                            class="text-blue-600 hover:underline"
                          >
                            Voltar para o Dashboard
                          </Link>

                </form>
            </section>
                     
        </main>
                         


</template>
