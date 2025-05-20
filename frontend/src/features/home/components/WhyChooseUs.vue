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
    <section class="pt-14 md:pt-24">
        <h2 class="text-[32px] md:text-[40px] text-textColor dark:text-white font-semibold">¿Por Qué Elegirnos?</h2>
        <div class="mt-8 grid md:grid-cols-2 lg:grid-cols-4 gap-6  md:gap-12">
            <div v-for="(item, index) in beneficios" :key="index">
                <div class="flex justify-center items-center mb-2 md:mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                    <component :is="iconMap[item.icono]" class="w-8 h-8 text-principalcolor stroke-1 lg:w-14 lg:h-14 dark:text-blue-400" />
                </div>
                <h3 class="mb-2 text-[20px] font-semibold dark:text-white">{{ item.titulo }}</h3>
                <p class="text-gray-500 text-[14px] dark:text-gray-400">{{ item.descripcion }}</p>
            </div>
        </div>
    </section>
</template>

<style scoped>
</style>
