
<script setup >
import { computed } from 'vue'


const props = defineProps({
  tickets: {
    type: Array,
    required: true
  },
 
})

const closedCount = computed(() => {
  if (!props.tickets) return 0
  return props.tickets.filter((t) => t.status === 'Fechado').length
})

const openCount = computed(() => {
  if (!props.tickets) return 0
  return props.tickets.filter((t) => t.status === 'Aberto').length
})


</script>

<template>
  <div class="flex gap-6">
    <div class="h-40 w-60 bg-red-200 flex flex-col justify-center items-center rounded-2xl border border-red-400 shadow">
      <p class="text-4xl font-bold">{{ closedCount }}</p>
      <h2 class="text-xl text-red-700">Fechados</h2>
    </div>
    <div class="h-40 w-60 bg-green-200 flex flex-col justify-center items-center rounded-2xl border border-green-400 shadow">
      <p class="text-4xl font-bold">{{ openCount }}</p>
      <h2 class="text-xl text-green-700">Abertos</h2>
    </div>
  </div>
</template>