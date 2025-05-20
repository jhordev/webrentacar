<script setup>
import { ref } from 'vue'
import CardBlog from '@/components/composite/CardBlog.vue'

import image1 from '@/assets/auto.jpg'
import {RouterLink} from "vue-router";

const blogItems = ref([
    {
        image: image1,
        title: 'Meet AutoManage, the best AI management tools',
        details: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        buttonText: 'View Details',
        buttonLink: '#',
        date: 'Dec 22, 2023'
    },
    {
        image: image1,
        title: 'How to earn more money as a wellness coach',
        details: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        buttonText: 'View Details',
        buttonLink: '#',
        date: 'Mar 15, 2023'
    },
    {
        image: image1,
        title: 'The no-fuss guide to upselling and cross selling',
        details: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        buttonText: 'View Details',
        buttonLink: '#',
        date: 'Jan 05, 2023'
    }
])
</script>

<template>
    <section class="pt-14 md:pt-24">
        <h2 class="text-[32px] md:text-[40px] text-textColor dark:text-white font-semibold">
            Últimas publicaciones de blog
        </h2>

        <div class="mt-7 grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
            <CardBlog
                v-for="(item, index) in blogItems"
                :key="index"
                v-bind="item"
            />
        </div>
        <div class="flex w-full justify-center md:justify-end mt-5">
            <RouterLink to="/" class="py-2 px-6 text-[16px] text-white font-semibold rounded-[8px] bg-principalcolor hover:scale-105 transition-all duration-300 ease-in-out">
                Ver más
            </RouterLink>
        </div>
    </section>
</template>
