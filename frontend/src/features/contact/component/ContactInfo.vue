<script setup>
import {IconMapPin, IconMail, IconPhone, IconBrandFacebook, IconBrandX, IconBrandInstagram} from '@tabler/icons-vue'
</script>

<template>
    <section class="flex flex-col justify-center gap-6 sm:gap-8 md:gap-10 rounded-lg border border-gray-300 dark:border-gray-700 w-full px-4 sm:px-6 md:px-8 py-6 sm:py-8 md:py-10">

        <!-- Header -->
        <div class="space-y-3 sm:space-y-4">
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                Detalles de contacto
            </h3>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300 leading-relaxed">
                Etiam pharetra egestas interdum blandit viverra morbi consequat
                mi non bibendum egestas quam egestas nulla.
            </p>
        </div>

        <!-- Info de contacto -->
        <div class="flex flex-col gap-5 sm:gap-6 md:gap-7">
            <!-- Dirección -->
            <div class="flex gap-3 sm:gap-4 group">
                <div class="flex-shrink-0 mt-1">
                    <IconMapPin class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"/>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm sm:text-base font-semibold text-gray-900 dark:text-white mb-1 sm:mb-2">
                        Dirección
                    </h4>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 leading-relaxed break-words">
                        123 Queensberry Street, North Melbourne VIC3051, Australia.
                    </p>
                </div>
            </div>

            <!-- Correo electrónico -->
            <div class="flex gap-3 sm:gap-4 group">
                <div class="flex-shrink-0 mt-1">
                    <IconMail class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"/>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm sm:text-base font-semibold text-gray-900 dark:text-white mb-1 sm:mb-2">
                        Correo electrónico
                    </h4>
                    <a href="mailto:ali@boxcars.com"
                       class="text-xs sm:text-sm text-blue-600 dark:text-blue-400 hover:underline break-all">
                        ali@boxcars.com
                    </a>
                </div>
            </div>

            <!-- Teléfono -->
            <div class="flex gap-3 sm:gap-4 group">
                <div class="flex-shrink-0 mt-1">
                    <IconPhone class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"/>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm sm:text-base font-semibold text-gray-900 dark:text-white mb-1 sm:mb-2">
                        Teléfono
                    </h4>
                    <a href="tel:+51959659501"
                       class="text-xs sm:text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        +51 959 659 501
                    </a>
                </div>
            </div>
        </div>

        <!-- Línea divisoria -->
        <div class="h-px bg-gradient-to-r from-transparent via-gray-300 dark:via-gray-600 to-transparent"></div>

        <!-- Redes sociales -->
        <div class="flex flex-col gap-4 sm:gap-5">
            <span class="text-sm sm:text-base font-semibold text-gray-900 dark:text-white">
                Síguenos en:
            </span>
            <div class="flex gap-3 sm:gap-4">
                <a href="/"
                   class="group flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-300 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950/30 transition-all duration-300 hover:scale-110"
                   aria-label="Facebook">
                    <IconBrandFacebook class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"/>
                </a>
                <a href="/"
                   class="group flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-300 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950/30 transition-all duration-300 hover:scale-110"
                   aria-label="X (Twitter)">
                    <IconBrandX class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"/>
                </a>
                <a href="/"
                   class="group flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-300 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950/30 transition-all duration-300 hover:scale-110"
                   aria-label="Instagram">
                    <IconBrandInstagram class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"/>
                </a>
            </div>
        </div>

    </section>
</template>

<style scoped>

</style>
