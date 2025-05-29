<script setup>
import { ref, computed, watch, onMounted } from 'vue'

const props = defineProps({
    modelValue: { type: Object, default: () => ({ min: 0, max: 1000 }) },
    min:        { type: Number, default: 0 },
    max:        { type: Number, default: 1000 },
    step:       { type: Number, default: 1 },
    currency:   { type: String, default: '$' },
    label:      { type: String, default: 'Rango' },
    name:       { type: String, default: '' }   // para el atributo for/id
})

const emit = defineEmits(['update:modelValue', 'change'])

const localMinValue = ref(props.modelValue.min || props.min)
const localMaxValue = ref(props.modelValue.max || props.max)

const minPercent = computed(
    () => ((localMinValue.value - props.min) / (props.max - props.min)) * 100
)
const maxPercent = computed(
    () => ((localMaxValue.value - props.min) / (props.max - props.min)) * 100
)

const syncValues = () => {
    const payload = { min: localMinValue.value, max: localMaxValue.value }
    emit('update:modelValue', payload)
    emit('change', payload)
}

const handleMinRange = () => {
    if (localMinValue.value >= localMaxValue.value)
        localMinValue.value = localMaxValue.value - props.step
    syncValues()
}
const handleMaxRange = () => {
    if (localMaxValue.value <= localMinValue.value)
        localMaxValue.value = localMinValue.value + props.step
    syncValues()
}
const handleMinInput = () => {
    if (localMinValue.value < props.min)
        localMinValue.value = props.min
    if (localMinValue.value >= localMaxValue.value)
        localMinValue.value = localMaxValue.value - props.step
    syncValues()
}
const handleMaxInput = () => {
    if (localMaxValue.value > props.max)
        localMaxValue.value = props.max
    if (localMaxValue.value <= localMinValue.value)
        localMaxValue.value = localMinValue.value + props.step
    syncValues()
}

watch(
    () => props.modelValue,
    (v) => {
        localMinValue.value = v.min ?? props.min
        localMaxValue.value = v.max ?? props.max
    },
    {deep: true}
)

onMounted(syncValues)
</script>

<template>
    <div class="w-full">
        <!-- Etiqueta -->
        <label
            :for="name"
            class="block text-[16px] uppercase font-medium text-gray-700 dark:text-white mb-4"
        >
            {{ label }}
        </label>

        <!-- Slider rango -->
        <div class="relative mb-6">
            <!-- Barra base -->
            <div class="relative h-2 bg-gray-200 rounded-full">
                <!-- Barra activa -->
                <div
                    class="absolute h-2 bg-blue-500 rounded-full"
                    :style="{ left: `${minPercent}%`, width: `${maxPercent - minPercent}%` }"
                ></div>
            </div>

            <!-- Thumbs -->
            <input
                v-model.number="localMinValue"
                type="range"
                :min="min"
                :max="max"
                :step="step"
                class="absolute inset-0 w-full appearance-none bg-transparent accent-blue-600 cursor-pointer"
                @input="handleMinRange"
            />
            <input
                v-model.number="localMaxValue"
                type="range"
                :min="min"
                :max="max"
                :step="step"
                class="absolute inset-0 w-full appearance-none bg-transparent accent-blue-600 cursor-pointer"
                @input="handleMaxRange"
            />
        </div>

        <!-- Inputs numéricos -->
        <div class="flex gap-4">
            <input
                v-model.number="localMinValue"
                type="number"
                :min="min"
                :max="max"
                :step="step"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-colorText dark:text-white outline-none"
                placeholder="Mín"
                @input="handleMinInput"
            />
            <input
                v-model.number="localMaxValue"
                type="number"
                :min="min"
                :max="max"
                :step="step"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-colorText dark:text-white outline-none"
                placeholder="Máx"
                @input="handleMaxInput"
            />
        </div>
    </div>
</template>
