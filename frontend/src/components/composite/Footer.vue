<script setup>
import {IconBrandFacebook, IconBrandX, IconBrandInstagram} from '@tabler/icons-vue'
import {Dot} from 'lucide-vue-next'
import NewsletterSignUp from "@/components/composite/NewsletterSignUp.vue";
</script>

<template>
    <footer class="bg-blueOscuro  mt-25">
        <div class="container-general pt-17 pb-17 grid grid-cols-12 gap-2 md:gap-10">
            <section class="col-span-10 lg:col-span-3 flex flex-col gap-1.5 mb-8 md:mb-0">
                <img src="@/assets/vue.svg" class="w-14 md:w-18 h-14 md:h-18">
                <h3 class="uppercase text-[26px] text-white font-semibold">CardMexico.com</h3>
                <p class="text-[14px] text-white font-normal leading-5">¡Recibe actualizaciones de precios, consejos de compra y más!</p>
                <span class="text-[14px] font-semibold text-white">Síguenos en nuestras redes:</span>
                <div class="flex gap-1.5 items-center text-white">
                    <a href="/"><IconBrandFacebook class="w-7 h-7"/></a>
                    <a href="/"><IconBrandX class="w-7 h-7"/></a>
                   <a href="/"> <IconBrandInstagram class="w-7 h-7"/></a>
                </div>
            </section>
            <section class="col-span-6 sm:col-span-6 lg:col-span-2">
                <h3 class="text-white text-[20px] font-semibold">Secciones</h3>
                <div class="mt-5 flex flex-col gap-3 text-white font-normal text-[14px]">
                    <RouterLink to="/">Inicio</RouterLink>
                    <RouterLink to="/motos-usadas">Motos Usadas</RouterLink>
                    <RouterLink to="/autos-usados">Autos Usados</RouterLink>
                    <RouterLink to="/motos-nuevas">Motos Nuevas</RouterLink>
                    <RouterLink to="/sobre-nosotros">Sobre Nosotros</RouterLink>
                    <RouterLink to="/blog">Blog</RouterLink>
                    <RouterLink to="/anunciate">Contáctanos</RouterLink>
                </div>
            </section>
            <section class="col-span-6 sm:col-span-6 lg:col-span-3">
                <h3 class="text-white text-[20px] font-semibold">Enlaces Rápidos</h3>
                <div class="mt-5 flex flex-col gap-3 text-white font-normal text-[14px]">
                    <RouterLink to="/">Preguntas Frecuentes</RouterLink>
                    <RouterLink to="/">Políticas de privacidad</RouterLink>
                    <RouterLink to="/">Anuncia con nosotros</RouterLink>
                </div>
            </section>
            <section class="col-span-12 lg:col-span-4 mt-8 md:mt-0">
                <h3 class="text-white text-[20px] font-semibold">Nuestro boletín informativo</h3>
                <p class="mt-2  text-white font-normal text-[14px] leading-5">¡Suscríbete a nuestra newsletter y recibe las últimas novedades sobre nuestros productos y servicios!</p>
                <NewsletterSignUp class="mt-4"/>
            </section>
        </div>
        <div class="border-t border-white/12">
            <div class="container-general py-7 flex flex-col text-center gap-2 md:flex-row items-center justify-between text-white text-[14px]">
                <p>&copy; 2025 ejemplo.com. Todos los derechos reservados.</p>
                <div class="flex items-center">
                    <a href="">Términos y Condiciones</a>
                    <Dot/>
                    <a href="">Políticas de privacidad</a>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>

</style>
