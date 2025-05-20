<script setup>
import { RouterLink } from 'vue-router';

const props = defineProps({ modelValue: String });
const emit = defineEmits(['update:modelValue']);

const tabs = ['Motos Usadas', 'Autos Usados', 'Motos Nuevas'];

const seleccionar = (tab) => {
    if (tab !== 'Motos Nuevas') {
        emit('update:modelValue', tab);
    }
};
</script>

<template>
    <div class="bg-transparent border-b border-transparent">
        <ul class="flex flex-wrap justify-between md:justify-start -mb-px  text-center">
            <li v-for="tab in tabs" :key="tab">
                <template v-if="tab === 'Motos Nuevas'">
                    <RouterLink
                        to="/motos-nuevas"
                        class="inline-block text-[14px] md:text-[16px] p-2 md:p-4 cursor-pointer border-b-2 border-transparent text-gray-500 hover:text-black dark:text-white/80 dark:hover:text-white hover:border-white/60 transition-colors duration-150"
                    >
                        {{ tab }}
                    </RouterLink>
                </template>
                <template v-else>
                    <button
                        type="button"
                        @click="seleccionar(tab)"
                        :class="[
              'inline-block text-[14px] md:text-[16px] p-2 md:p-4 cursor-pointer border-b-2 rounded-t-lg transition-colors duration-150',
              modelValue === tab
                ? 'border-white text-black dark:text-white'
                : 'border-transparent text-gray-500 hover:text-black dark:text-white/80 dark:hover:text-white hover:border-white/60'
            ]"
                    >
                        {{ tab }}
                    </button>
                </template>
            </li>
        </ul>
    </div>
</template>
