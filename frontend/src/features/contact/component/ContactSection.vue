<script setup>

import ContactForm from "@/features/contact/component/ContactForm.vue";
import ContactInfo from "@/features/contact/component/ContactInfo.vue";
</script>

<template>
  <section class="mt-12 sm:mt-16 md:mt-20 lg:mt-24 bg-gray-50/80 dark:bg-gray-800/80 backdrop-blur-sm px-4 sm:px-6 md:px-8 lg:px-10 py-6 sm:py-8 md:py-10 lg:py-12 rounded-xl sm:rounded-2xl shadow-sm">
    <div class="flex flex-col lg:flex-row gap-6 sm:gap-8 md:gap-10 lg:gap-12 xl:gap-16">
      <!-- Formulario de contacto - ocupa más espacio en desktop -->
      <ContactForm class="w-full lg:flex-1"/>

      <!-- Información de contacto - ocupa menos espacio en desktop -->
      <ContactInfo class="w-full lg:w-[400px] xl:w-[450px]"/>
    </div>
  </section>
</template>

<style scoped>

</style>
