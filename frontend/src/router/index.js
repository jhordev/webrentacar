import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import UsedMotorcyclesView from "@/views/UsedMotorcyclesView.vue";
import UsedCarsView from "@/views/UsedCarsView.vue";
import NewMotorcyclesView from "@/views/NewMotorcyclesView.vue";
import AboutUsView from "@/views/AboutUsView.vue";
import BlogView from "@/views/BlogView.vue";
import AdvertiseView from "@/views/AdvertiseView.vue";
import FaqView from "@/views/FaqView.vue";
import NotFoundView from "@/views/NotFoundView.vue";


const routes = [
    { path: '/', name: 'Home', component: HomeView },
    { path: '/motos-usadas', name: 'MotosUsadas', component: UsedMotorcyclesView },
    { path: '/autos-usados', name: 'AutosUsados', component: UsedCarsView },
    { path: '/motos-nuevas', name: 'MotosNuevas', component: NewMotorcyclesView },
    { path: '/sobre-nosotros', name: 'SobreNosotros', component: AboutUsView },
    { path: '/blog', name: 'Blog', component: BlogView },
    { path: '/anunciate', name: 'Anunciate', component: AdvertiseView },
    { path: '/faq', name: 'FAQ', component: FaqView },

    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFoundView }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
