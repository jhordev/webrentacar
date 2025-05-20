<script setup>

import Header from "@/components/composite/Header.vue";
import Footer from "@/components/composite/Footer.vue";
import HeroComponent from "@/features/home/components/HeroComponent.vue";
import UsedMotos from "@/features/home/components/UsedMotos.vue";
import UsedAutos from "@/features/home/components/UsedAutos.vue";
import AgencyMotos from "@/features/home/components/AgencyMotos.vue";
</script>

<template>
    <Header/>
    <HeroComponent/>
    <div class="container-general">
        <UsedMotos/>
        <UsedAutos/>
        <AgencyMotos/>
    </div>
    <Footer/>
</template>

<style scoped>

</style>
