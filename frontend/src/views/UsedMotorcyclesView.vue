<script setup>

import Footer from "@/components/composite/Footer.vue";
import Header from "@/components/composite/Header.vue";
import PageHeader from "@/components/composite/PageHeader.vue";
import SelectFiltro from "@/components/ui/SelectFiltro.vue";
import {ref} from "vue";
import FilterVehicle from "@/components/composite/FilterVehicle.vue";



</script>

<template>
    <Header header-type="full"/>
    <main class="mt-16 md:mt-32 container-general">
        <PageHeader title="Motos Usadas" current="Motos Usadas" />
        <section class="grid grid-cols-12 ">
            <div class="col-span-3">
                <FilterVehicle/>
            </div>
            <div class="col-span-9">

            </div>
        </section>
    </main>
    <Footer/>
</template>

<style scoped>

</style>
