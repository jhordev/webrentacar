<script setup>
import { ref } from 'vue';

const props = defineProps({
    pregunta: {
        type: String,
        required: true
    },
    respuesta: {
        type: String,
        required: true
    },
    inicialmenteAbierto: {
        type: Boolean,
        default: false
    }
});

const abierto = ref(props.inicialmenteAbierto);
</script>

<template>
    <div class="border border-gray-300 dark:border-gray-600 rounded-[15px] overflow-hidden">
        <h2>
            <button
                type="button"
                class="flex w-full items-center justify-between gap-3 px-4 py-5 font-medium text-gray-800 dark:text-gray-200"
                @click="abierto = !abierto"
                :aria-expanded="abierto"
            >
                <span class="text-[14px] md:text-[18px]">{{ pregunta }}</span>
                <svg
                    class="h-3 w-3 transition-transform duration-200"
                    :class="{ 'rotate-180': abierto }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 10 6"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5 5 1 1 5"
                    />
                </svg>
            </button>
        </h2>

        <transition name="accordion">
            <div
                v-show="abierto"
                class="px-4 pb-5"
            >
                <p class="mb-2 text-[12px] md:text-[14px] text-gray-700 dark:text-gray-300">
                    {{ respuesta }}
                </p>
            </div>
        </transition>
    </div>
</template>

<style scoped>
.accordion-enter-from,
.accordion-leave-to {
    max-height: 0;
    opacity: 0;
}

.accordion-enter-to,
.accordion-leave-from {
    max-height: 1000px;
    opacity: 1;
}

.accordion-enter-active,
.accordion-leave-active {
    overflow: hidden;
    transition:
        max-height 350ms cubic-bezier(0.25, 0.8, 0.25, 1),
        opacity 350ms ease;
}
</style>
