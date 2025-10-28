import { createApp } from 'vue'
import '@/assets/css/main.css'
import App from './App.vue'
import router from '@/router'
import { useDarkMode } from '@/composables/useDarkMode'

// Inicializar dark mode antes de montar la app
const { initializeDarkMode, listenToSystemPreference } = useDarkMode()
initializeDarkMode()
listenToSystemPreference()

createApp(App).use(router).mount('#app')
