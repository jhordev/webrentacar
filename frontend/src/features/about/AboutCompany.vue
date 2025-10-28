<script setup>

</script>

<template>
    <section class="py-10 sm:py-14 md:py-20 lg:py-24 bg-gradient-to-br from-blueOscuro/5 via-gray-50 to-principalcolor/5 dark:from-blueOscuro dark:via-gray-900 dark:to-blueOscuro">
        <div class="container-general">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 md:gap-10 lg:gap-12 items-center">

                <!-- Contenido de texto -->
                <div class="col-span-1 lg:col-span-7 order-2 lg:order-1">
                    <div class="space-y-4 sm:space-y-6">
                        <!-- Badge -->
                        <div class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 bg-principalcolor/10 dark:bg-blue-400/10 rounded-full">
                            <span class="text-xs sm:text-sm font-semibold text-principalcolor dark:text-blue-400">
                                Acerca de Nosotros
                            </span>
                        </div>

                        <!-- Título -->
                        <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                            Nosotros
                        </h2>

                        <!-- Línea decorativa -->
                        <div class="w-20 sm:w-24 h-1 bg-gradient-to-r from-principalcolor to-blue-400"></div>

                        <!-- Descripción -->
                        <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-300 leading-relaxed max-w-3xl">
                            Somos un sitio web local especializado en la publicación de motos y autos que abarca principalmente las ciudades de
                            <span class="font-semibold text-principalcolor dark:text-blue-400">Moroleón, Uriangato y Yuriria</span>
                            en el estado de Guanajuato y algunos alrededores muy cercanos.
                        </p>

                        <!-- Stats/Features -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 sm:gap-6 pt-4 sm:pt-6">
                            <div class="space-y-1 sm:space-y-2">
                                <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-principalcolor dark:text-blue-400">
                                    3+
                                </div>
                                <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                    Ciudades cubiertas
                                </div>
                            </div>
                            <div class="space-y-1 sm:space-y-2">
                                <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-principalcolor dark:text-blue-400">
                                    100%
                                </div>
                                <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                    Local
                                </div>
                            </div>
                            <div class="space-y-1 sm:space-y-2 col-span-2 sm:col-span-1">
                                <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-principalcolor dark:text-blue-400">
                                    24/7
                                </div>
                                <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                    Disponible
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Imagen -->
                <div class="col-span-1 lg:col-span-5 order-1 lg:order-2 relative">
                    <!-- Decoración de fondo -->
                    <div class="absolute -inset-4 sm:-inset-6 bg-gradient-to-br from-principalcolor/20 to-blue-400/20 dark:from-blue-400/10 dark:to-principalcolor/10 rounded-2xl sm:rounded-3xl blur-2xl"></div>

                    <!-- Tarjeta de sombra decorativa -->
                    <div class="absolute inset-0 bg-principalcolor/10 dark:bg-blue-400/10 rounded-2xl sm:rounded-3xl -rotate-3"></div>

                    <!-- Imagen principal -->
                    <div class="relative transform hover:scale-105 transition-transform duration-500">
                        <img
                            src="@/assets/venta.jpg"
                            class="w-full h-64 sm:h-80 md:h-96 lg:h-full object-cover rounded-2xl sm:rounded-3xl shadow-2xl"
                            alt="Venta de vehículos en Guanajuato"
                        />
                        <!-- Overlay gradiente -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-2xl sm:rounded-3xl"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
