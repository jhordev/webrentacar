<script setup>
import Footer from "@/components/composite/Footer.vue";
import Header from "@/components/composite/Header.vue";
import PageHeader from "@/components/composite/PageHeader.vue";
import AboutCompany from "@/features/about/AboutCompany.vue";
</script>

<template>
    <Header header-type="inline"/>
    <main class="mt-16 md:mt-20 container-general">
        <PageHeader title="Sobre Nosotros" current="Sobre Nosotros" />
        <AboutCompany/>
    </main>
    <Footer/>
</template>

<style scoped>

</style>
