<script setup lang="ts">
// Agora os nomes batem exatamente com as chaves do array do Laravel
const props = defineProps<{
    openTickets: number,
    closedTickets: number,
    totalTickets: number
}>();
</script>

<template>
    <div>
        <h1 class="p-2 text-2xl text-center font-semibold">Quantidade de Chamados por Status</h1>
        
        <QuantidadeCard class="p-3" />

        <div class="flex justify-center gap-4">
            
            <div class="h-15 w-50 flex flex-col justify-center bg-green-500 items-center rounded-xl text-white font-semibold text-center">
                Chamados Abertos
                <div>
                    {{ openTickets }}
                </div>
            </div>

            <div class="h-15 w-50 flex flex-col justify-center bg-red-500 items-center rounded-xl text-white font-semibold text-center">
                Chamados Fechados
                <div>
                    {{ closedTickets }}
                </div>
            </div>

        </div>
    </div>
</template>