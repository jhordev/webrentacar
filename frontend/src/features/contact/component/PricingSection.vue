<script setup>
import PricingCard from '@/components/composite/PricingCard.vue';

// Datos de los planes
const planStandar = {
    precio: '29.00',
    titulo: 'Anuncio Standar',
    descripcion: 'Solo un único pago hasta que se venda',
    caracteristicas: [
        'Primero en la lista',
        'Hasta 12 imágenes',
        '1 Video',
        'Tomar fotos y datos a domicilio o en nuestra dirección'
    ],
    isPremium: false,
    recomendado: false
};

const planPremium = {
    precio: '39.00',
    titulo: 'Anuncio Premium',
    descripcion: 'Solo un único pago hasta que se venda',
    caracteristicas: [
        'Primero en la lista',
        'Hasta 12 imágenes',
        '1 Video',
        'Tomar fotos y datos a domicilio o en nuestra dirección'
    ],
    isPremium: true,
    recomendado: true
};

// Manejadores de eventos
const handleContratarStandar = (datos) => {
    console.log('Contratando plan Standar:', datos);
    // Aquí puedes agregar tu lógica de negocio
};

const handleContratarPremium = (datos) => {
    console.log('Contratando plan Premium:', datos);
    // Aquí puedes agregar tu lógica de negocio
};
</script>

<template>
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-2 items-center">
                <h2 class="text-color-textColor dark:text-white text-[40px] font-bold text-center">Precios de anuncios</h2>
                <span class="text-[16px] font-normal text-color-textColor/80 dark:text-white/80">Da a conocer tu auto o moto en la web</span>
            </div>

            <!-- Cards de pricing -->
            <div class="flex mt-10 flex-col lg:flex-row gap-8 justify-center items-center lg:items-stretch">
                <!-- Card Standar -->
                <PricingCard
                    :precio="planStandar.precio"
                    :titulo="planStandar.titulo"
                    :descripcion="planStandar.descripcion"
                    :caracteristicas="planStandar.caracteristicas"
                    :isPremium="planStandar.isPremium"
                    :recomendado="planStandar.recomendado"
                    @contratar="handleContratarStandar"
                />



                <!-- Card Premium -->
                <PricingCard
                    :precio="planPremium.precio"
                    :titulo="planPremium.titulo"
                    :descripcion="planPremium.descripcion"
                    :caracteristicas="planPremium.caracteristicas"
                    :isPremium="planPremium.isPremium"
                    :recomendado="planPremium.recomendado"
                    @contratar="handleContratarPremium"
                />
            </div>
        </div>
    </section>
</template>
