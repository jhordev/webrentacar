import { ref, watch } from 'vue'

// Estado global compartido
const isDark = ref(false)
let isInitialized = false

// Actualizar el DOM agregando/quitando clase 'dark'
const updateDOM = () => {
  if (isDark.value) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }
}

// Guardar preferencia en localStorage
const savePreference = () => {
  localStorage.setItem('theme', isDark.value ? 'dark' : 'light')
}

// Watch global para detectar cambios en isDark
watch(isDark, () => {
  updateDOM()
  savePreference()
})

export function useDarkMode() {
  // Alternar entre modo claro y oscuro
  const toggleDarkMode = () => {
    isDark.value = !isDark.value
  }

  // Establecer modo específico
  const setDarkMode = (value) => {
    isDark.value = value
  }

  // Inicializar dark mode al cargar la app
  const initializeDarkMode = () => {
    if (isInitialized) return
    isInitialized = true

    const savedTheme = localStorage.getItem('theme')

    if (savedTheme) {
      isDark.value = savedTheme === 'dark'
    } else {
      isDark.value = false // Modo claro por defecto
    }

    updateDOM()
  }

  // Escuchar cambios en preferencia del sistema operativo
  const listenToSystemPreference = () => {
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)')

    mediaQuery.addEventListener('change', (e) => {
      if (!localStorage.getItem('theme')) {
        isDark.value = e.matches
      }
    })
  }

  return {
    isDark,
    toggleDarkMode,
    setDarkMode,
    initializeDarkMode,
    listenToSystemPreference
  }
}
