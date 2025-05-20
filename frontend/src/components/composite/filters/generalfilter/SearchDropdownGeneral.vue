<script setup>
import { ref } from 'vue';
import TabsFiltro from '@/components/composite/filters/generalfilter/TabsFiltro.vue';
import FormularioFiltro from '@/components/composite/filters/generalfilter/FormFiltro.vue';

const tabSeleccionada = ref('Motos Usadas');
</script>

<template>
    <div class="flex flex-col gap-2 w-full">
        <TabsFiltro v-model="tabSeleccionada" />
        <FormularioFiltro :tipo="tabSeleccionada" />
    </div>
</template>
