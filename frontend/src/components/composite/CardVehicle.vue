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
    <article
        class="group w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl sm:rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden"
    >
        <!-- Imagen del Vehículo -->
        <div class="relative overflow-hidden">
            <a href="#" class="block relative">
                <img
                    class="w-full h-40 sm:h-48 md:h-52 lg:h-56 object-cover transform transition-transform duration-500 group-hover:scale-110"
                    :src="imagen"
                    :alt="titulo"
                />

                <!-- Overlay gradiente en hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <!-- Badge Premium/Estándar -->
                <div
                    v-if="premium"
                    class="absolute top-2 right-2 sm:top-3 sm:right-3 py-1 px-3 sm:py-1.5 sm:px-4 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg shadow-md"
                >
                    <span class="text-xs sm:text-sm font-semibold text-white">Premium</span>
                </div>
                <div
                    v-else
                    class="absolute top-2 right-2 sm:top-3 sm:right-3 py-1 px-3 sm:py-1.5 sm:px-4 bg-principalcolor rounded-lg shadow-md"
                >
                    <span class="text-xs sm:text-sm font-medium text-white">Estándar</span>
                </div>
            </a>
        </div>

        <!-- Contenido del Card -->
        <div class="p-3 sm:p-4 md:p-5 space-y-3 sm:space-y-4">

            <!-- Sección: ID, Título y Precio -->
            <div class="pb-3 sm:pb-4 border-b border-gray-200 dark:border-gray-700 space-y-1 sm:space-y-2">
                <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium">
                    ID: {{ id }}
                </span>

                <a href="#" class="block group/title">
                    <h5 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2 group-hover/title:text-principalcolor dark:group-hover/title:text-blue-400 transition-colors duration-300">
                        {{ titulo }}
                    </h5>
                </a>

                <div class="flex items-baseline gap-1">
                    <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">$</span>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-principalcolor dark:text-blue-400">
                        {{ precio.toLocaleString() }}
                    </h3>
                </div>
            </div>

            <!-- Sección: Especificaciones (Combustible, Motor, Kilometraje) -->
            <div class="py-3 sm:py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="grid grid-cols-3 gap-2 sm:gap-3 md:gap-4">
                    <!-- Combustible -->
                    <div class="flex flex-col items-center gap-1 sm:gap-2 text-gray-700 dark:text-gray-300 hover:text-principalcolor dark:hover:text-blue-400 transition-colors duration-300">
                        <IconGasStation class="w-5 h-5 sm:w-6 sm:h-6"/>
                        <span class="text-xs sm:text-sm font-medium text-center break-words">
                            {{ combustible }}
                        </span>
                    </div>

                    <!-- Cilindrada -->
                    <div class="flex flex-col items-center gap-1 sm:gap-2 text-gray-700 dark:text-gray-300 hover:text-principalcolor dark:hover:text-blue-400 transition-colors duration-300">
                        <IconEngine class="w-5 h-5 sm:w-6 sm:h-6"/>
                        <span class="text-xs sm:text-sm font-medium text-center break-words">
                            {{ cilindrada }}
                        </span>
                    </div>

                    <!-- Kilometraje -->
                    <div class="flex flex-col items-center gap-1 sm:gap-2 text-gray-700 dark:text-gray-300 hover:text-principalcolor dark:hover:text-blue-400 transition-colors duration-300">
                        <IconDashboard class="w-5 h-5 sm:w-6 sm:h-6"/>
                        <span class="text-xs sm:text-sm font-medium text-center break-words">
                            {{ kilometraje }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Sección: Ubicación -->
            <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                <MapPin class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0 text-principalcolor dark:text-blue-400"/>
                <span class="text-xs sm:text-sm md:text-base font-medium truncate">
                    {{ ubicacion }}
                </span>
            </div>
        </div>
    </article>
</template>

<style scoped>
/* Limitar líneas del título */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
