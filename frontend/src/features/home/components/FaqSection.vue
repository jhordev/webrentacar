<script setup>

import FaqAccordion from "@/components/composite/FaqAccordion.vue";

const faqs = [
    {
        pregunta: "¿Cómo publico un vehículo en la plataforma?",
        respuesta: "Solo necesitas crear una cuenta, llenar el formulario con los datos del vehículo y subir fotos. El proceso toma menos de 5 minutos."
    },
    {
        pregunta: "¿Es gratis publicar mi anuncio?",
        respuesta: "Sí, puedes publicar tus vehículos sin costo. También ofrecemos opciones destacadas por si deseas mayor visibilidad."
    },
    {
        pregunta: "¿Cómo sé que los anunciantes son reales?",
        respuesta: "Todos los usuarios pasan por un proceso de verificación para garantizar la seguridad y confianza en las publicaciones."
    },
    {
        pregunta: "¿Puedo editar mi anuncio después de publicarlo?",
        respuesta: "Sí, desde tu panel puedes modificar datos, cambiar imágenes o desactivar el anuncio en cualquier momento."
    },
    {
        pregunta: "¿Tienen soporte en caso tenga problemas?",
        respuesta: "Claro, nuestro equipo de soporte está disponible 24/7 para ayudarte vía chat o correo electrónico."
    }
];


</script>

<template>
    <section class="pt-14 md:pt-24">
        <h2 class="text-[32px] md:text-[40px] text-textColor dark:text-white font-semibold">Preguntas Frecuentes</h2>
        <div class="mt-8 flex flex-col gap-4">
            <FaqAccordion
                v-for="(item, index) in faqs"
                :key="index"
                :pregunta="item.pregunta"
                :respuesta="item.respuesta"
                :inicialmenteAbierto="index === 0"
            />
        </div>
    </section>
</template>

<style scoped>

</style>
