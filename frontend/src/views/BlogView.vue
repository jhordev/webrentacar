<script setup>
import { ref } from 'vue'
import Header from "@/components/composite/Header.vue";
import Footer from "@/components/composite/Footer.vue";
import PageHeader from "@/components/composite/PageHeader.vue";
import CardBlog from "@/components/composite/CardBlog.vue";
import autoImg from "@/assets/auto.jpg";

const blogs = ref([
    {
        id: 1,
        image: autoImg,
        title: 'Los mejores consejos para rentar un auto en 2024',
        details: 'Descubre todo lo que necesitas saber antes de rentar un vehículo. Desde documentación necesaria hasta tips para ahorrar en tu renta.',
        buttonText: 'Leer más',
        buttonLink: '#',
        date: '15 Oct 2024'
    },
    {
        id: 2,
        image: autoImg,
        title: 'Mantenimiento de vehículos: Guía completa',
        details: 'Aprende sobre el mantenimiento preventivo y correctivo de tu auto. Consejos profesionales para mantener tu vehículo en óptimas condiciones.',
        buttonText: 'Leer más',
        buttonLink: '#',
        date: '12 Oct 2024'
    },
    {
        id: 3,
        image: autoImg,
        title: 'Seguridad vial: Tips esenciales para conductores',
        details: 'La seguridad al conducir es fundamental. Conoce las mejores prácticas y recomendaciones para un viaje seguro.',
        buttonText: 'Leer más',
        buttonLink: '#',
        date: '08 Oct 2024'
    },
    {
        id: 4,
        image: autoImg,
        title: 'Beneficios de rentar vs comprar un vehículo',
        details: 'Análisis completo de las ventajas y desventajas entre rentar y comprar. Toma la mejor decisión según tus necesidades.',
        buttonText: 'Leer más',
        buttonLink: '#',
        date: '05 Oct 2024'
    },
    {
        id: 5,
        image: autoImg,
        title: 'Destinos turísticos en Guanajuato',
        details: 'Explora los mejores lugares para visitar en Guanajuato. Rutas recomendadas y sitios imperdibles en tu próximo viaje.',
        buttonText: 'Leer más',
        buttonLink: '#',
        date: '01 Oct 2024'
    },
    {
        id: 6,
        image: autoImg,
        title: 'Tecnología automotriz: Innovaciones recientes',
        details: 'Conoce las últimas innovaciones en tecnología automotriz. Desde sistemas de seguridad hasta conectividad avanzada.',
        buttonText: 'Leer más',
        buttonLink: '#',
        date: '28 Sep 2024'
    }
])
</script>

<template>
    <Header header-type="none"/>
    <main class="mt-16 md:mt-20 container-general">
        <PageHeader title="Blog" current="Blog" />

        <!-- Grid de Cards Blog -->
        <section class="">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 md:gap-6 lg:gap-8">
                <CardBlog
                    v-for="blog in blogs"
                    :key="blog.id"
                    :image="blog.image"
                    :title="blog.title"
                    :details="blog.details"
                    :button-text="blog.buttonText"
                    :button-link="blog.buttonLink"
                    :date="blog.date"
                />
            </div>
        </section>
    </main>
    <Footer/>
</template>

<style scoped>

</style>
