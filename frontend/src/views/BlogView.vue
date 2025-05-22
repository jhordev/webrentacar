<script setup>

import Header from "@/components/composite/Header.vue";
import Footer from "@/components/composite/Footer.vue";
import PageHeader from "@/components/composite/PageHeader.vue";
</script>

<template>
    <Header header-type="none"/>
    <main class="mt-16 md:mt-20 container-general">
        <PageHeader title="Blog" current="Blog" />
    </main>
    <Footer/>
</template>

<style scoped>

</style>
