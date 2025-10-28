<script setup>
import { ref, computed, watch, onMounted, nextTick, getCurrentInstance } from 'vue';

const props = defineProps({
  pregunta: { type: String, required: true },
  respuesta: { type: String, required: true },
  inicialmenteAbierto: { type: Boolean, default: false },
  disabled: { type: Boolean, default: false }
});

const abierto = ref(!!props.inicialmenteAbierto);
const contentRef = ref(null);
const heightPx = ref('0px');
const isAnimating = ref(false);

// ID único para aria-*
const uid = `acc-${getCurrentInstance().uid}`;
const contentId = `${uid}-content`;
const buttonId = `${uid}-button`;

// Clases calculadas
const containerClasses = computed(() => [
  'relative rounded-2xl border overflow-hidden',
  'bg-white/90 dark:bg-gray-900/80',
  'border-gray-200/80 dark:border-gray-700/60',
  'shadow-sm hover:shadow-lg',
  'transition-all duration-500 ease-out',
  abierto.value ? 'ring-2 ring-blue-500/20' : '',
  'backdrop-blur supports-[backdrop-filter]:bg-white/60 dark:supports-[backdrop-filter]:bg-gray-900/50'
]);

const buttonClasses = computed(() => [
  'group flex w-full items-center justify-between gap-4',
  'px-5 md:px-6 py-4 md:py-5 text-left',
  'font-semibold md:font-semibold',
  'text-gray-900 dark:text-gray-100',
  'focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500/40 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:focus-visible:ring-offset-gray-900',
  'rounded-2xl',
  'transition-all duration-300 ease-out',
  props.disabled
    ? 'opacity-60 cursor-not-allowed'
    : 'hover:bg-gray-50/80 dark:hover:bg-gray-800/60'
]);

const titleClasses = computed(() => [
  'leading-relaxed transition-colors duration-300',
  'text-sm sm:text-base md:text-lg',
  abierto.value ? 'text-blue-600 dark:text-blue-400' : ''
]);

const iconWrapperClasses = computed(() => [
  'relative flex h-8 w-8 shrink-0 items-center justify-center',
  'rounded-full border',
  'border-gray-300/60 dark:border-gray-600/50',
  'bg-white dark:bg-gray-900',
  'transition-all duration-500 ease-out',
  abierto.value
    ? 'border-blue-400/70 bg-blue-50 dark:bg-blue-950/50 scale-110 shadow-md'
    : props.disabled ? '' : 'group-hover:border-blue-300/70 group-hover:bg-blue-50/50 dark:group-hover:bg-blue-950/30 group-hover:scale-105'
]);

const iconClasses = computed(() => [
  'h-4 w-4',
  'transition-all duration-500 ease-[cubic-bezier(0.68,-0.55,0.265,1.55)] motion-reduce:transition-none',
  abierto.value ? 'rotate-180 text-blue-600 dark:text-blue-400 scale-110' : 'rotate-0 text-gray-500 dark:text-gray-400'
]);

// Altura animada con curva mejorada
const setHeight = (open) => {
  const el = contentRef.value;
  if (!el) return;

  // Respetar usuarios con reducción de movimiento
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (prefersReduced) {
    heightPx.value = open ? 'auto' : '0px';
    return;
  }

  isAnimating.value = true;

  if (open) {
    // De 0 -> altura real con animación suave
    heightPx.value = '0px';
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        const full = `${el.scrollHeight}px`;
        heightPx.value = full;
        const onEnd = () => {
          heightPx.value = 'auto';
          el.removeEventListener('transitionend', onEnd);
          isAnimating.value = false;
        };
        el.addEventListener('transitionend', onEnd);
      });
    });
  } else {
    // De auto -> altura fija -> 0 con animación suave
    const current = `${el.scrollHeight}px`;
    heightPx.value = current;
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        heightPx.value = '0px';
        const onEnd = () => {
          el.removeEventListener('transitionend', onEnd);
          isAnimating.value = false;
        };
        el.addEventListener('transitionend', onEnd);
      });
    });
  }
};

const toggle = () => {
  if (props.disabled) return;
  abierto.value = !abierto.value;
};

watch(() => props.inicialmenteAbierto, (v) => {
  abierto.value = !!v;
});

watch(abierto, (v) => nextTick(() => setHeight(v)));

onMounted(() => {
  // set inicial
  nextTick(() => {
    heightPx.value = abierto.value ? 'auto' : '0px';
  });
});
</script>

<template>
  <div :class="containerClasses">
    <!-- borde/halo sutil -->
    <div class="pointer-events-none absolute inset-0 rounded-2xl ring-1 ring-black/0 dark:ring-white/0"></div>

    <h2 class="m-0">
      <button
        :id="buttonId"
        type="button"
        :class="buttonClasses"
        :aria-expanded="abierto"
        :aria-controls="contentId"
        @click="toggle"
      >
        <span :class="titleClasses">
          {{ pregunta }}
        </span>

        <span :class="iconWrapperClasses" aria-hidden="true">
          <svg
            :class="iconClasses"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2.5"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
          <!-- brillo hover -->
          <span
            class="pointer-events-none absolute inset-0 rounded-full opacity-0 transition-opacity duration-300 group-hover:opacity-20
                   bg-gradient-to-r from-blue-400 to-purple-400 blur-[6px]"
          />
        </span>
      </button>
    </h2>

    <!-- Contenido -->
    <div
      :id="contentId"
      role="region"
      :aria-labelledby="buttonId"
      ref="contentRef"
      class="transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] motion-reduce:transition-none overflow-hidden"
      :style="{ height: heightPx }"
    >
      <div
        class="px-5 md:px-6 pb-5 md:pb-6"
        :class="[
          'transition-all duration-500 ease-out motion-reduce:transition-none',
          abierto
            ? 'opacity-100 translate-y-0'
            : 'opacity-0 -translate-y-4',
        ]"
        :inert="!abierto && !isAnimating ? '' : null"
      >
        <!-- divider con animación -->
        <div
          class="h-px bg-gradient-to-r from-transparent via-gray-200 dark:via-gray-700 to-transparent mb-4 transition-all duration-700"
          :class="abierto ? 'opacity-100 scale-x-100' : 'opacity-0 scale-x-75'"
        />

        <!-- contenido -->
        <div
          class="prose prose-sm md:prose-base max-w-none
                 text-gray-700 dark:text-gray-300
                 prose-p:my-0 prose-a:text-blue-600 dark:prose-a:text-blue-400
                 transition-all duration-500 ease-out"
          :class="abierto ? 'blur-none' : 'blur-sm'"
        >
          <!-- Soporta slot opcional, cae a 'respuesta' si no hay slot -->
          <slot>
            <p>{{ respuesta }}</p>
          </slot>
        </div>

        <!-- indicador sutil con animación mejorada -->
        <div class="mt-4 flex justify-center overflow-hidden">
          <div
            class="h-1 w-10 rounded-full bg-gradient-to-r from-blue-400 via-purple-400 to-blue-400
                   transition-all duration-700 ease-out"
            :class="abierto ? 'opacity-30 scale-100' : 'opacity-0 scale-50'"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Optimización para animaciones suaves */
div[role="region"] {
  overflow: hidden;
  will-change: height;
}

/* Mejora el rendimiento de las animaciones */
.transition-all {
  backface-visibility: hidden;
  transform: translateZ(0);
}
</style>
