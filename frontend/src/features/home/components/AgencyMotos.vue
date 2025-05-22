<script setup>
import { RouterLink } from "vue-router"
import CardAgency from "@/components/composite/CardAgency.vue"
import imagenAgencia from '@/assets/marca.png'
import imageSusuki from '@/assets/susuki.png'
import imageYamaha from '@/assets/yamaha.png'
import imageKtm from '@/assets/ktm.png'

// Array con los datos de las agencias
const agencias = [
    {
        marca: 'Honda',
        sucursales: ['Ciudad de México', 'Querétaro', 'Jalisco', 'Yucatán'],
        imagen: imagenAgencia
    },
    {
        marca: 'Yamaha',
        sucursales: ['Lima', 'Trujillo', 'Arequipa', 'Cusco'],
        imagen: imageYamaha
    },
    {
        marca: 'Suzuki',
        sucursales: ['Bogotá', 'Medellín', 'Cali', 'Barranquilla'],
        imagen: imageSusuki
    },
    {
        marca: 'KTM',
        sucursales: ['Buenos Aires', 'Córdoba', 'Rosario'],
        imagen: imageKtm
    },
]
</script>

<template>
    <section class="pt-14 md:pt-19">
        <h2 class="text-[32px] md:text-[40px] text-textColor dark:text-white font-semibold">Agencias de Motos</h2>
        <div class="mt-7 grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4">
            <CardAgency
                v-for="(agencia, index) in agencias"
                :key="index"
                :marca="agencia.marca"
                :sucursales="agencia.sucursales"
                :imagen="agencia.imagen"
            />
        </div>
        <div class="flex w-full justify-center md:justify-end mt-5">
            <RouterLink
                to="/"
                class="py-2 px-6 text-[16px] text-white font-semibold rounded-[8px] bg-principalcolor hover:scale-105 transition-all duration-300 ease-in-out"
            >
                Ver más
            </RouterLink>
        </div>
    </section>
</template>

<style scoped>
</style>
