<script setup>

import Header from "@/components/composite/Header.vue";
import Footer from "@/components/composite/Footer.vue";
import HeroSection from "@/features/home/components/HeroSection.vue";
import UsedMotos from "@/features/home/components/UsedMotos.vue";
import UsedAutos from "@/features/home/components/UsedAutos.vue";
import AgencyMotos from "@/features/home/components/AgencyMotos.vue";
import WhyChooseUs from "@/features/home/components/WhyChooseUs.vue";
import FaqSection from "@/features/home/components/FaqSection.vue";
import BlogSection from "@/features/home/components/BlogSection.vue";
</script>

<template>
    <Header  />
    <HeroSection/>
    <div class="container-general">
        <UsedMotos/>
        <UsedAutos/>
        <AgencyMotos/>
        <WhyChooseUs/>
        <FaqSection/>
        <BlogSection/>
    </div>
    <Footer/>
</template>

<style scoped>

</style>
