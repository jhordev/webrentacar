<script setup>
import { ref } from 'vue';
const nombre = ref('');
const email = ref('');
const tel = ref('');
const address = ref('');
const asunto = ref('');
const description = ref('');

import BaseInput from "@/components/ui/BaseInput.vue";
import BaseTextArea from "@/components/ui/BaseTextArea.vue";
</script>

<template>
    <div class="w-full">
        <!-- Header -->
        <div class="space-y-3 sm:space-y-4">
            <h2 class="text-gray-900 dark:text-white font-bold text-2xl sm:text-3xl md:text-4xl lg:text-5xl">
                Contáctanos
            </h2>
            <p class="text-gray-600 dark:text-white/80 text-sm sm:text-base leading-relaxed">
                Etiam pharetra egestas interdum blandit viverra morbi consequat mi non bibendum
                egestas quam egestas nulla.
            </p>
        </div>

        <!-- Formulario -->
        <form class="mt-6 sm:mt-8 md:mt-10">
           <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
               <!-- Nombre -->
               <BaseInput
                   class="col-span-1 sm:col-span-2 md:col-span-1"
                   v-model="nombre"
                   placeholder="Ingresa tu nombre"
                   label="Nombre completo"
                   required
               />

               <!-- Email -->
               <BaseInput
                   class="col-span-1 sm:col-span-2 md:col-span-1"
                   v-model="email"
                   type="email"
                   placeholder="correo@ejemplo.com"
                   label="Correo electrónico"
                   required
               />

               <!-- Teléfono -->
               <BaseInput
                   class="col-span-1 sm:col-span-2 md:col-span-1"
                   v-model="tel"
                   type="tel"
                   placeholder="Ingresa tu teléfono"
                   label="Número telefónico"
                   required
               />

               <!-- Dirección -->
               <BaseInput
                   class="col-span-1 sm:col-span-2 md:col-span-1"
                   v-model="address"
                   placeholder="Ingresa tu dirección"
                   label="Dirección"
                   required
               />

               <!-- Asunto -->
               <BaseInput
                   class="col-span-1 sm:col-span-2"
                   v-model="asunto"
                   placeholder="Ingrese su asunto"
                   label="Asunto a contactar"
                   required
               />

               <!-- Descripción -->
               <BaseTextArea
                   v-model="description"
                   placeholder="Escribe una descripción..."
                   label="Descripción del producto"
                   resize="vertical"
                   required
                   show-counter
                   maxlength="500"
                   class="col-span-1 sm:col-span-2"
               />
           </div>

            <!-- Botón de envío -->
            <button
                type="submit"
                class="mt-6 sm:mt-8 w-full sm:w-auto rounded-2xl bg-principalcolor hover:bg-principalcolor/90 active:scale-95 py-3 sm:py-3.5 px-6 sm:px-10 text-white font-semibold text-sm sm:text-base cursor-pointer transition-all duration-300 shadow-md hover:shadow-lg">
                Enviar mensaje
            </button>
        </form>
    </div>
</template>

<style scoped>

</style>
