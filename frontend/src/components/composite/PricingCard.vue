<script setup>
import { computed } from 'vue';

const props = defineProps({
    precio: {
        type: [String, Number],
        required: true
    },
    titulo: {
        type: String,
        required: true
    },
    descripcion: {
        type: String,
        required: true
    },
    caracteristicas: {
        type: Array,
        required: true
    },
    isPremium: {
        type: Boolean,
        default: false
    },
    recomendado: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['contratar']);

// Clases computadas para el contenedor principal
const containerClasses = computed(() => [
    'relative p-8 rounded-3xl transition-all duration-300 hover:shadow-lg',
    'border',
    props.isPremium
        ? 'bg-slate-900 text-white border-slate-800'
        : 'bg-white dark:bg-slate-800 text-gray-900 dark:text-white border-gray-200 dark:border-slate-700'
]);

// Clases para el precio
const precioClasses = computed(() => [
    'text-4xl font-bold mb-2',
    props.isPremium
        ? 'text-white'
        : 'text-gray-900 dark:text-white'
]);

// Clases para la descripción
const descripcionClasses = computed(() => [
    'text-sm mb-6',
    props.isPremium
        ? 'text-gray-300'
        : 'text-gray-600 dark:text-gray-300'
]);

// Clases para el título del plan
const tituloClasses = computed(() => [
    'text-xl font-semibold mb-6',
    props.isPremium
        ? 'text-white'
        : 'text-gray-900 dark:text-white'
]);

// Clases para las características
const caracteristicaClasses = computed(() => [
    'flex items-center gap-3 mb-4 text-sm',
    props.isPremium
        ? 'text-gray-100'
        : 'text-gray-700 dark:text-gray-200'
]);

// Clases para el botón
const botonClasses = computed(() => [
    'w-full py-3 px-6 rounded-xl font-medium transition-all duration-200',
    'focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-slate-800',
    props.isPremium
        ? 'bg-white text-slate-900 hover:bg-gray-100 focus:ring-white'
        : 'bg-transparent border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white focus:ring-blue-500 dark:border-blue-400 dark:text-blue-400 dark:hover:bg-blue-400 dark:hover:text-white'
]);

const handleContratar = () => {
    emit('contratar', { titulo: props.titulo, precio: props.precio });
};
</script>

<template>
    <div :class="containerClasses" class="max-w-sm">
        <!-- Badge recomendado -->
        <div
            v-if="recomendado"
            class="absolute -top-3 right-6 bg-yellow-400 text-slate-900 text-xs font-semibold px-3 py-1 rounded-full"
        >
            Recomendado
        </div>

        <!-- Precio -->
        <div :class="precioClasses">
            ${{ precio }}
        </div>

        <!-- Descripción -->
        <p :class="descripcionClasses">
            {{ descripcion }}
        </p>

        <!-- Título del plan -->
        <h3 :class="tituloClasses">
            {{ titulo }}
        </h3>

        <!-- Lista de características -->
        <div class="mb-8">
            <div
                v-for="(caracteristica, index) in caracteristicas"
                :key="index"
                :class="caracteristicaClasses"
            >
                <!-- Ícono de check -->
                <div class="flex-shrink-0">
                    <div class="w-5 h-5 rounded-full flex items-center justify-center"
                         :class="isPremium ? 'bg-green-500' : 'bg-blue-500 dark:bg-blue-400'">
                        <svg
                            class="w-3 h-3 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="3"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                <!-- Texto de la característica -->
                <span class="leading-relaxed">{{ caracteristica }}</span>
            </div>
        </div>

        <!-- Botón de contratar -->
        <button
            :class="botonClasses"
            class="cursor-pointer"
            @click="handleContratar"
        >
            Contratar
        </button>
    </div>
</template>
