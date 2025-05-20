<script setup>
import { RouterLink } from 'vue-router'
import CardVehicle from "@/components/composite/CardVehicle.vue"
import moto1 from '@/assets/moto.jpg'

const motosNuevas = [
    {
        id: '1000001',
        titulo: 'Ford Transit – 2021',
        precio: 20000,
        combustible: 'Gasolina',
        cilindrada: '77 cc',
        kilometraje: '52,999 km',
        ubicacion: 'Ciudad de México',
        imagen: moto1,
        premium: true
    },
    {
        id: '1000002',
        titulo: 'Yamaha FZ – 2023',
        precio: 18500,
        combustible: 'Gasolina',
        cilindrada: '149 cc',
        kilometraje: '0 km',
        ubicacion: 'Guadalajara',
        imagen: moto1,
        premium: true
    },
    {
        id: '1000003',
        titulo: 'Honda CB500X – 2022',
        precio: 32000,
        combustible: 'Gasolina',
        cilindrada: '471 cc',
        kilometraje: '5,200 km',
        ubicacion: 'Querétaro',
        imagen: moto1,
        premium: true
    },
    {
        id: '1000004',
        titulo: 'Suzuki GSX-R600 – 2020',
        precio: 29500,
        combustible: 'Gasolina',
        cilindrada: '599 cc',
        kilometraje: '12,800 km',
        ubicacion: 'Puebla',
        imagen: moto1,
        premium: true
    },
    {
        id: '1000005',
        titulo: 'KTM Duke 390 – 2023',
        precio: 24500,
        combustible: 'Gasolina',
        cilindrada: '373 cc',
        kilometraje: '800 km',
        ubicacion: 'Monterrey',
        imagen: moto1,
        premium: true
    }
]
</script>

<template>
    <section class="pt-14 md:pt-19">
        <h2 class="text-[32px] md:text-[40px] text-textColor dark:text-white font-semibold">Motos usadas</h2>
        <div class="mt-7 grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4">
            <CardVehicle
                v-for="moto in motosNuevas.slice(0, 4)"
                :key="moto.id"
                :id="moto.id"
                :titulo="moto.titulo"
                :precio="moto.precio"
                :combustible="moto.combustible"
                :cilindrada="moto.cilindrada"
                :kilometraje="moto.kilometraje"
                :ubicacion="moto.ubicacion"
                :imagen="moto.imagen"
                :premium="moto.premium"
                tipo="Motocicleta"
            />
        </div>
        <div class="flex w-full justify-center md:justify-end mt-5">
            <RouterLink to="/" class="py-2 px-6 text-[16px] text-white font-semibold rounded-[8px] bg-principalcolor hover:scale-105 transition-all duration-300 ease-in-out">
                Ver más
            </RouterLink>
        </div>
    </section>
</template>

<style scoped>
</style>
