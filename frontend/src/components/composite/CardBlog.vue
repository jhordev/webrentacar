<script setup>
import { Dot } from 'lucide-vue-next'
defineProps({
    image:       { type: String, required: true },
    title:       { type: String, required: true },
    details:     { type: String, required: true },
    buttonText:  { type: String, required: true },
    buttonLink:  { type: String, required: true },
    date:        { type: String, required: true }
})
</script>

<template>
    <div class="w-full mb-10">
        <div class="mb-2 overflow-hidden rounded-[16px]">
            <img :src="image" :alt="title" class="w-full" />
        </div>

     <div>
         <div class="flex gap-1.5 text-gray-500 dark:text-white mb-3 ">
             <span class="inline-block text-xs font-semibold leading-loose rounded bg-primary">Admin</span>
             <Dot />
             <span class="inline-block text-xs font-semibold leading-loose  text-gray-500 dark:text-white rounded bg-primary">{{ date }}</span>
         </div>
         <h3>
             <a
                 :href="buttonLink"
                 class="inline-block mb-2 text-xl font-semibold text-dark dark:text-white hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl "
             >
                 {{ title }}
             </a>
         </h3>
         <p class="text-base text-body-color dark:text-dark-6 line-clamp-2">
             {{ details }}
         </p>
     </div>
    </div>
</template>
