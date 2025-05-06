import { createApp } from 'vue'
import App from './App.vue'
import './../css/app.css'
import router from './router'

import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'

createApp(App)
    .use(router)
    .use(ElementPlus)
    .mount('#app')
