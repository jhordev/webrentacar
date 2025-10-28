<script setup>
import { MapPin, ChevronRight } from 'lucide-vue-next'

defineProps({
    marca: { type: String, required: true },
    sucursales: { type: Array, required: true },
    imagen: { type: String, required: true }
})
</script>

<template>
    <article
        class="group w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl sm:rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden"
    >
        <!-- Logo de la Agencia/Marca -->
        <div class="relative overflow-hidden border-b border-gray-200 dark:border-gray-700 h-48 sm:h-52 md:h-56 lg:h-60 flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
            <a href="#" class="relative group/logo w-full h-full flex items-center justify-center p-6 sm:p-8 md:p-10">
                <img
                    class="max-h-full max-w-full object-contain transform transition-all duration-500 group-hover/logo:scale-110 filter group-hover/logo:brightness-110"
                    :src="imagen"
                    :alt="`Logo de ${marca}`"
                />

                <!-- Overlay en hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>

            <!-- Nombre de la Marca (overlay en la parte inferior) -->
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/60 to-transparent py-3 sm:py-4 px-4">
                <a href="#" class="block group/marca">
                    <h5 class="text-base sm:text-lg md:text-xl font-bold text-white uppercase text-center tracking-wide group-hover/marca:text-blue-300 transition-colors duration-300 drop-shadow-lg">
                        {{ marca }}
                    </h5>
                </a>
            </div>
        </div>

        <!-- Contenido del Card: Sucursales -->
        <div class="p-4 sm:p-5 md:p-6 space-y-3 sm:space-y-4">
            <!-- Título de sección -->
            <div class="flex items-center gap-2">
                <MapPin class="w-5 h-5 text-principalcolor dark:text-blue-400 flex-shrink-0"/>
                <h3 class="text-sm sm:text-base md:text-lg font-semibold text-gray-900 dark:text-white">
                    Sucursales
                </h3>
                <span class="ml-auto text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium">
                    ({{ sucursales.length }})
                </span>
            </div>

            <!-- Lista de Sucursales -->
            <ul class="space-y-2 sm:space-y-2.5">
                <li
                    v-for="(sucursal, index) in sucursales"
                    :key="index"
                    class="group/item"
                >
                    <a
                        href="/"
                        class="flex items-center gap-2 sm:gap-3 px-2 sm:px-3 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-300 group-hover/item:translate-x-1"
                    >
                        <!-- Bullet point -->
                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-principalcolor dark:bg-blue-400 flex-shrink-0 group-hover/item:scale-125 transition-transform duration-300"></span>

                        <!-- Nombre de la sucursal -->
                        <span class="text-xs sm:text-sm md:text-base text-gray-700 dark:text-gray-300 group-hover/item:text-principalcolor dark:group-hover/item:text-blue-400 transition-colors duration-300 flex-1 truncate">
                            {{ sucursal }}
                        </span>

                        <!-- Icono de flecha (chevron) -->
                        <ChevronRight class="w-4 h-4 text-gray-400 dark:text-gray-500 group-hover/item:text-principalcolor dark:group-hover/item:text-blue-400 opacity-0 group-hover/item:opacity-100 transition-all duration-300 flex-shrink-0"/>
                    </a>
                </li>
            </ul>

            <!-- Footer: Ver todas las sucursales (opcional) -->
            <div class="pt-2 sm:pt-3 border-t border-gray-200 dark:border-gray-700">
                <a
                    href="#"
                    class="flex items-center justify-center gap-2 py-2 sm:py-2.5 px-4 rounded-lg bg-principalcolor/10 dark:bg-blue-400/10 hover:bg-principalcolor/20 dark:hover:bg-blue-400/20 transition-all duration-300 group/btn"
                >
                    <span class="text-xs sm:text-sm font-semibold text-principalcolor dark:text-blue-400">
                        Ver todas las sucursales
                    </span>
                    <ChevronRight class="w-4 h-4 text-principalcolor dark:text-blue-400 group-hover/btn:translate-x-1 transition-transform duration-300"/>
                </a>
            </div>
        </div>
    </article>
</template>


<style scoped>
</style>
