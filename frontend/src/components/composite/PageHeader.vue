<script setup>
import {House, ChevronRight} from 'lucide-vue-next'
defineProps({
    title: String,
    current: String
})
</script>

<template>
    <div class=" py-8 md:py-12">
        <nav class="text-[12px] md:text-[14px] text-gray-600 dark:text-white flex items-center gap-2">
            <RouterLink to="/" class="flex items-center gap-1">
                <House class="text-textColor dark:text-white w-3.5 md:w-4 h-3.5 md:h-4"/>
                Home
            </RouterLink>
            <ChevronRight class="text-textColor dark:text-white w-3.5 h-3.5 md:w-4 md:h-4" />
            <span class="text-blue-600 dark:text-blue-200">{{ current }}</span>
        </nav>
        <h1 class="text-[32px] md:text-[40px] font-bold text-textColor dark:text-white mt-2">{{ title }}</h1>
    </div>
</template>

<style scoped>

</style>
