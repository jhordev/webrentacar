<script setup>
import SearchDropdown from "@/components/composite/filters/generalfilter/SearchDropdownGeneral.vue";
import { MoveRight} from 'lucide-vue-next'
</script>

<template>
    <section class="bg-hero relative">
        <div class="absolute top-18  lg:top-20 inset-0 z-10 custom-gradient-top"></div>
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 z-10 custom-gradient"></div>
        <div class="grid container-general px-4 py-28 md:py-34 mx-auto relative z-10 gap-3 md:gap-10 lg:py-52 lg:grid-cols-12">
            <div class="order-1 lg:order-2 lg:col-span-6 flex flex-col justify-center text-left">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-[2px] md:tracking-[5px] leading-none md:text-5xl xl:text-6xl text-white leading-[90px]">
                    Encuentra tu próxima moto o auto ideal para ti
                </h1>
                <p class=" max-w-2xl mb-6 font-light text-white lg:mb-8 md:text-lg lg:text-xl">
                    El Primer sitio exclusivo de motos y autos en Moroleón, Uriangato y Yuriria.
                </p>
                <div class="hidden md:flex flex-wrap gap-3">
                    <a
                        href="#"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900 cursor-pointer transform transition-transform duration-200 hover:translate-x-1"
                    >
                        Anuncia con nosotros

                        <MoveRight class="w-5 h-5 ml-2 -mr-1" />
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-white border border-gray-300 rounded-lg hover:bg-principalcolor hover:bg-opacity-50 focus:ring-4 focus:ring-gray-100 transition-colors duration-300 ease-in-out">
                        Anuncia con nosotros
                    </a>
                </div>
            </div>
            <div class="order-2 lg:order-1 lg:col-span-6 flex items-center">
                <SearchDropdown />
            </div>
        </div>
    </section>
</template>

<style scoped>
.bg-hero {
    background-image: url('../../../assets/hero.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: bottom;
}
.custom-gradient {
    background: linear-gradient(to bottom, transparent 75%, #111827 100%);
}
.custom-gradient-top {
    background: linear-gradient(to top, transparent 60%, #111827 100%);
}
</style>
