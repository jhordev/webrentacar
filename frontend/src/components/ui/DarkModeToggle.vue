<script setup>
import { IconSun, IconMoon } from '@tabler/icons-vue'
import { useDarkMode } from '@/composables/useDarkMode'

const { isDark, toggleDarkMode } = useDarkMode()
</script>

<template>
  <button
    @click="toggleDarkMode"
    :aria-label="isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
    class="group relative flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 hover:scale-110 active:scale-95 shadow-sm hover:shadow-md overflow-hidden"
  >
    <!-- Icono Sol (modo claro activo) -->
    <Transition
      enter-active-class="transition-all duration-500 ease-out"
      enter-from-class="opacity-0 rotate-90 scale-50"
      enter-to-class="opacity-100 rotate-0 scale-100"
      leave-active-class="transition-all duration-500 ease-in"
      leave-from-class="opacity-100 rotate-0 scale-100"
      leave-to-class="opacity-0 -rotate-90 scale-50"
    >
      <IconSun
        v-if="!isDark"
        class="absolute w-5 h-5 sm:w-6 sm:h-6 text-yellow-500 group-hover:text-yellow-600 transition-colors duration-300"
        :stroke-width="2.5"
      />
    </Transition>

    <!-- Icono Luna (modo oscuro activo) -->
    <Transition
      enter-active-class="transition-all duration-500 ease-out"
      enter-from-class="opacity-0 -rotate-90 scale-50"
      enter-to-class="opacity-100 rotate-0 scale-100"
      leave-active-class="transition-all duration-500 ease-in"
      leave-from-class="opacity-100 rotate-0 scale-100"
      leave-to-class="opacity-0 rotate-90 scale-50"
    >
      <IconMoon
        v-if="isDark"
        class="absolute w-5 h-5 sm:w-6 sm:h-6 text-blue-400 group-hover:text-blue-300 transition-colors duration-300"
        :stroke-width="2.5"
      />
    </Transition>

    <!-- Efecto de brillo al hover -->
    <span
      class="pointer-events-none absolute inset-0 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300 bg-gradient-to-r blur-md"
      :class="isDark ? 'from-blue-400 to-purple-400' : 'from-yellow-400 to-orange-400'"
    />
  </button>
</template>

<style scoped>
/* Optimización para animaciones suaves */
button {
  backface-visibility: hidden;
  transform: translateZ(0);
}
</style>
