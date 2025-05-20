<script setup>
import { MapPin } from 'lucide-vue-next'
import { IconEngine, IconGasStation, IconDashboard } from '@tabler/icons-vue'

defineProps({
    id: {type: [String, Number], required: true},
    titulo: {type: String, required: true},
    precio: {type: [String, Number], required: true},
    tipo: {type: String, required: true},
    combustible: {type: String, required: true},
    kilometraje: {type: String, required: true},
    cilindrada: {type: String, required: true},
    imagen: {type: String, required: true},
    ubicacion: {type: String, required: true},
    premium: {type: Boolean, default: false}
})
</script>

<template>
    <div
        class="w-full md:max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="overflow-hidden rounded-t-lg">
            <a href="#" class="relative group">
                <img
                    class="rounded-t-lg  transform transition-transform duration-300 group-hover:scale-105 w-full h-52 object-cover"
                    :src="imagen"
                    :alt="titulo"
                />
                <div v-if="premium" class="absolute top-0 right-0 py-0.5 px-5 bg-yellow-400 rounded-[5px]">
                    <span class="text-[14px] font-semibold text-white">Premium</span>
                </div>
                <div v-else="premium" class="absolute top-0 right-0 py-0.5 px-5 bg-principalcolor rounded-[5px]">
                    <span class="text-[14px] font-medium text-white">Estandar</span>
                </div>
            </a>
        </div>
        <div class="p-5">
            <div class="pb-3 border-b-1  border-gray-300 dark:border-gray-600">
                <span class="text-[14px] text-textColor dark:text-white">{{ id }}</span>
                <a href="#">
                    <h5 class="mt-1 text-[20px] font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ titulo }}
                    </h5>
                </a>
                <h3 class="text-[24px] font-semibold mt-2 text-textColor dark:text-white">${{
                        precio.toLocaleString()
                    }}</h3>
            </div>
            <div class="py-3 border-b-1  border-gray-300 dark:border-gray-600 flex justify-between gap-x-6 gap-y-2">
                <div class="text-textColor dark:text-white flex flex-col items-center gap-1">
                    <IconGasStation class="w-6 h-6"/>
                    <span class="text-[14px] font-medium">{{ combustible }}</span>
                </div>
                <div class="text-textColor dark:text-white flex flex-col items-center gap-1">
                    <IconEngine class="w-6 h-6"/>
                    <span class="text-[14px] font-medium">{{ cilindrada }}</span>
                </div>
                <div class="text-textColor dark:text-white flex flex-col items-center gap-1">
                    <IconDashboard class="w-6 h-6"/>
                    <span class="text-[14px] font-medium">{{ kilometraje }}</span>
                </div>
            </div>
            <div class="text-textColor dark:text-white pt-3 flex gap-2 items-center">
                <MapPin class="w-6 h-6"/>
                <span class="text-[15px] font-medium">{{ ubicacion }}</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
