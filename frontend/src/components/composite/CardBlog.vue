<script setup>
import { Dot } from 'lucide-vue-next'

defineProps({
    image:       { type: String, required: true },
    title:       { type: String, required: true },
    details:     { type: String, required: true },
    buttonText:  { type: String, required: true },
    buttonLink:  { type: String, required: true },
    date:        { type: String, required: true }
})
</script>

<template>
    <article
        class="group w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl sm:rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden"
    >
        <!-- Imagen del Blog -->
        <div class="relative overflow-hidden">
            <a :href="buttonLink" class="block relative">
                <img
                    :src="image"
                    :alt="title"
                    class="w-full h-40 sm:h-48 md:h-52 lg:h-56 object-cover transform transition-transform duration-500 group-hover:scale-110"
                />

                <!-- Overlay gradiente en hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
        </div>

        <!-- Contenido del Card -->
        <div class="p-3 sm:p-4 md:p-5 space-y-3 sm:space-y-4">

            <!-- Metadata: Admin y Fecha -->
            <div class="flex items-center gap-1 sm:gap-1.5 text-gray-500 dark:text-gray-400">
                <span class="inline-flex items-center px-2 sm:px-2.5 py-0.5 sm:py-1 text-xs font-semibold rounded-md bg-principalcolor/10 dark:bg-blue-400/10 text-principalcolor dark:text-blue-400">
                    Admin
                </span>
                <Dot class="w-4 h-4 flex-shrink-0"/>
                <span class="inline-flex items-center px-2 sm:px-2.5 py-0.5 sm:py-1 text-xs font-semibold rounded-md bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                    {{ date }}
                </span>
            </div>

            <!-- Título -->
            <h3 class="space-y-2">
                <a
                    :href="buttonLink"
                    class="block text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-gray-900 dark:text-white hover:text-principalcolor dark:hover:text-blue-400 transition-colors duration-300 line-clamp-2"
                >
                    {{ title }}
                </a>
            </h3>

            <!-- Detalles/Descripción -->
            <p class="text-xs sm:text-sm md:text-base text-gray-600 dark:text-gray-300 line-clamp-2 leading-relaxed">
                {{ details }}
            </p>
        </div>
    </article>
</template>

<style scoped>
/* Limitar líneas del título y descripción */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
