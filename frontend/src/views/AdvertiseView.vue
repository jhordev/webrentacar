<script setup>

import Footer from "@/components/composite/Footer.vue";
import Header from "@/components/composite/Header.vue";
import PageHeader from "@/components/composite/PageHeader.vue";
import PricingSection from "@/features/contact/component/PricingSection.vue";
import ContactSection from "@/features/contact/component/ContactSection.vue";
</script>

<template>
    <Header header-type="inline"/>
    <main class="mt-16 md:mt-20 container-general">
        <PageHeader title="Contáctanos" current="Contáctanos" />
        <!-- Precios -->
        <PricingSection/>
        <ContactSection/>
    </main>
    <Footer/>
</template>

<style scoped>

</style>
