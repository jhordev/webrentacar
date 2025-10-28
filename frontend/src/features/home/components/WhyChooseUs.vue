<script setup>
import { IconClockBolt, IconRosetteDiscountCheck, IconHeadset } from '@tabler/icons-vue'
import { Gem } from 'lucide-vue-next'

const iconMap = {
    IconClockBolt,
    IconRosetteDiscountCheck,
    IconHeadset,
    Gem
};

const beneficios = [
    {
        titulo: "Publicación Rápida",
        descripcion: "Publica tu vehículo en menos de 5 minutos, de forma segura y confiable.",
        icono: "IconClockBolt"
    },
    {
        titulo: "Anunciantes Verificados",
        descripcion: "Cuidamos la seguridad: todos los usuarios pasan por un proceso de verificación.",
        icono: "IconRosetteDiscountCheck"
    },
    {
        titulo: "Precios Claros",
        descripcion: "Tú decides el precio y el trato. No cobramos comisión por ventas.",
        icono: "Gem"
    },
    {
        titulo: "Asesoría para Vender Mejor",
        descripcion: "Te damos consejos para que tu anuncio destaque y vendas más rápido.",
        icono: "IconHeadset"
    }
];
</script>

<template>
    <section class="pt-10 sm:pt-14 md:pt-20 lg:pt-24">
        <!-- Título de la sección -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-gray-900 dark:text-white font-bold text-center sm:text-left">
            ¿Por Qué Elegirnos?
        </h2>

        <!-- Grid de beneficios -->
        <div class="mt-6 sm:mt-8 md:mt-10 lg:mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 md:gap-10 lg:gap-12">
            <article
                v-for="(item, index) in beneficios"
                :key="index"
                class="group flex flex-col items-center sm:items-start text-center sm:text-left p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
            >
                <!-- Icono -->
                <div class="flex justify-center items-center mb-3 sm:mb-4 w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full bg-principalcolor/10 dark:bg-blue-400/10 group-hover:bg-principalcolor/20 dark:group-hover:bg-blue-400/20 group-hover:scale-110 transition-all duration-300">
                    <component
                        :is="iconMap[item.icono]"
                        class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 text-principalcolor dark:text-blue-400 stroke-[1.5]"
                    />
                </div>

                <!-- Título -->
                <h3 class="mb-2 sm:mb-3 text-base sm:text-lg md:text-xl font-bold text-gray-900 dark:text-white group-hover:text-principalcolor dark:group-hover:text-blue-400 transition-colors duration-300">
                    {{ item.titulo }}
                </h3>

                <!-- Descripción -->
                <p class="text-xs sm:text-sm md:text-base text-gray-600 dark:text-gray-400 leading-relaxed">
                    {{ item.descripcion }}
                </p>
            </article>
        </div>
    </section>
</template>

<style scoped>
</style>
