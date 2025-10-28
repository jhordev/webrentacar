<script setup>
import { Target, Eye, BookOpen } from 'lucide-vue-next'
</script>

<template>
    <section class="py-10 sm:py-14 md:py-20 lg:py-24 container-general">

        <!-- Misión -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 md:gap-10 lg:gap-12 items-center">
            <!-- Imagen -->
            <div class="order-1 lg:order-1 relative group">
                <div class="absolute -inset-4 bg-gradient-to-br from-principalcolor/20 to-blue-400/20 dark:from-blue-400/10 dark:to-principalcolor/10 rounded-2xl sm:rounded-3xl blur-2xl opacity-75"></div>
                <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl shadow-2xl">
                    <img
                        src="@/assets/venta.jpg"
                        class="w-full h-64 sm:h-80 md:h-96 object-cover transform group-hover:scale-110 transition-transform duration-700"
                        alt="Nuestra misión de venta de vehículos"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="order-2 lg:order-2 space-y-4 sm:space-y-6">
                <!-- Icono y badge -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-principalcolor/10 dark:bg-blue-400/10">
                        <Target class="w-6 h-6 sm:w-7 sm:h-7 text-principalcolor dark:text-blue-400" />
                    </div>
                    <div class="inline-flex items-center px-3 sm:px-4 py-1 sm:py-1.5 bg-principalcolor/10 dark:bg-blue-400/10 rounded-full">
                        <span class="text-xs sm:text-sm font-semibold text-principalcolor dark:text-blue-400">
                            Nuestra Misión
                        </span>
                    </div>
                </div>

                <!-- Título -->
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white leading-tight">
                    Promover la venta de motos y autos de nuestros clientes
                </h2>

                <!-- Línea decorativa -->
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-principalcolor to-blue-400"></div>

                <!-- Descripción -->
                <p class="text-sm sm:text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                    Nuestra misión es clara, enfocarnos principalmente en la
                    <span class="font-semibold text-principalcolor dark:text-blue-400">satisfacción de nuestros clientes</span>
                    logrando concretar la venta de su vehículo lo más pronto posible en nuestro portal profesional exclusivo de solo motos y autos.
                </p>
                <p class="text-sm sm:text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                    En nuestro equipo, valoramos la calidad, la sostenibilidad y el servicio al cliente. ¡Estaremos siempre dispuestos a ayudarte!
                </p>
            </div>
        </div>

        <!-- Visión -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 md:gap-10 lg:gap-12 items-center pt-12 sm:pt-16 md:pt-20 lg:pt-28">
            <!-- Imagen -->
            <div class="order-1 lg:order-2 relative group">
                <div class="absolute -inset-4 bg-gradient-to-br from-blue-400/20 to-principalcolor/20 dark:from-principalcolor/10 dark:to-blue-400/10 rounded-2xl sm:rounded-3xl blur-2xl opacity-75"></div>
                <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl shadow-2xl">
                    <img
                        src="@/assets/venta.jpg"
                        class="w-full h-64 sm:h-80 md:h-96 object-cover transform group-hover:scale-110 transition-transform duration-700"
                        alt="Nuestra visión de futuro"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="order-2 lg:order-1 space-y-4 sm:space-y-6">
                <!-- Icono y badge -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-blue-400/10 dark:bg-principalcolor/10">
                        <Eye class="w-6 h-6 sm:w-7 sm:h-7 text-principalcolor dark:text-blue-400" />
                    </div>
                    <div class="inline-flex items-center px-3 sm:px-4 py-1 sm:py-1.5 bg-blue-400/10 dark:bg-principalcolor/10 rounded-full">
                        <span class="text-xs sm:text-sm font-semibold text-principalcolor dark:text-blue-400">
                            Nuestra Visión
                        </span>
                    </div>
                </div>

                <!-- Título -->
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white leading-tight">
                    Ser líderes en la región
                </h2>

                <!-- Línea decorativa -->
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-400 to-principalcolor"></div>

                <!-- Descripción -->
                <p class="text-sm sm:text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                    Impulsar la compra y venta de motos y autos en la región a través de nuestro sitio
                    <span class="font-semibold text-principalcolor dark:text-blue-400">exclusivo y profesional</span>.
                </p>
                <p class="text-sm sm:text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                    Nuestro objetivo es ser líder en nuestra zona centro sur del estado de Guanajuato y lugares aledaños, y convertirnos en el
                    <span class="font-semibold text-principalcolor dark:text-blue-400">sitio web por excelencia</span> de la gente.
                </p>
            </div>
        </div>

        <!-- Nuestra Historia -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 md:gap-10 lg:gap-12 items-center pt-12 sm:pt-16 md:pt-20 lg:pt-28">
            <!-- Imagen -->
            <div class="order-1 lg:order-1 relative group">
                <div class="absolute -inset-4 bg-gradient-to-br from-principalcolor/20 to-purple-400/20 dark:from-purple-400/10 dark:to-principalcolor/10 rounded-2xl sm:rounded-3xl blur-2xl opacity-75"></div>
                <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl shadow-2xl">
                    <img
                        src="@/assets/venta.jpg"
                        class="w-full h-64 sm:h-80 md:h-96 object-cover transform group-hover:scale-110 transition-transform duration-700"
                        alt="Nuestra historia"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="order-2 lg:order-2 space-y-4 sm:space-y-6">
                <!-- Icono y badge -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-purple-400/10 dark:bg-purple-400/10">
                        <BookOpen class="w-6 h-6 sm:w-7 sm:h-7 text-principalcolor dark:text-blue-400" />
                    </div>
                    <div class="inline-flex items-center px-3 sm:px-4 py-1 sm:py-1.5 bg-purple-400/10 dark:bg-purple-400/10 rounded-full">
                        <span class="text-xs sm:text-sm font-semibold text-principalcolor dark:text-blue-400">
                            Nuestra Historia
                        </span>
                    </div>
                </div>

                <!-- Título -->
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white leading-tight">
                    Nuestro Origen
                </h2>

                <!-- Línea decorativa -->
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-purple-400 to-principalcolor"></div>

                <!-- Descripción -->
                <div class="space-y-3 sm:space-y-4">
                    <p class="text-sm sm:text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        Seguramente has observado que en los sitios web existentes a nivel nacional de anuncios de autos y motos solo se enfocan en publicitar anuncios de las principales ciudades como
                        <span class="font-semibold">CDMX, Guadalajara, Puebla</span>, descuidando en su totalidad las publicaciones de regiones más pequeñas incluyendo la nuestra.
                    </p>
                    <p class="text-sm sm:text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        Realmente si deseamos buscar algún vehículo de nuestra zona no aparece absolutamente nada, nos sentimos totalmente limitados. Por ello, entendemos con claridad la necesidad de las personas que desean publicar su vehículo en una
                        <span class="font-semibold text-principalcolor dark:text-blue-400">plataforma web profesional, local y exclusiva</span>
                        para dar a conocer su vehículo al público de la zona.
                    </p>
                    <p class="text-sm sm:text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        Derivado a esto, es que surge nuestro portal
                        <span class="font-bold text-principalcolor dark:text-blue-400">autocar.mx</span>
                        para integrar en un solo sitio los anuncios de motos y autos y lo más importante, que estén dentro de nuestra zona.
                    </p>
                </div>
            </div>
        </div>

    </section>
</template>

<style scoped>

</style>
