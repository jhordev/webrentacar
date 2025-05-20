<script setup>
defineProps({
    marca: { type: String, required: true },
    sucursales: { type: Array, required: true },
    imagen: { type: String, required: true }
})
</script>

<template>
    <div class="w-full md:max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="overflow-hidden rounded-t-lg relative border-b-1 border-gray-300 dark:border-gray-600 h-[240px] flex items-center justify-center bg-white dark:bg-gray-700">
            <a href="#" class="relative group w-full h-full rounded-lg flex items-center justify-center">
                <img
                    class=" p-10 transform transition-transform rounded-lg duration-300 group-hover:scale-105 max-h-full max-w-full object-contain"
                    :src="imagen"
                    :alt="marca"
                />
            </a>
            <a href="#" class="absolute mb-3 bottom-0 flex justify-center w-full">
                <h5 class="text-[20px] font-semibold text-gray-900 dark:text-white uppercase">{{ marca }}</h5>
            </a>
        </div>

        <div class="px-5 py-4">
            <h3 class="text-[18px] font-semibold text-textColor dark:text-white">Sucursal:</h3>
            <ul class="ml-3 text-[14px] flex flex-col gap-2.5 mt-2.5 text-textColor dark:text-white">
                <li v-for="(sucursal, index) in sucursales" :key="index" class="cursor-pointer transform transition-transform duration-300 hover:translate-x-1">
                    <a href="/" >{{ sucursal }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>


<style scoped>
</style>
