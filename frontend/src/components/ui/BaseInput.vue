<!-- BaseInput.vue -->
<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    },
    type: {
        type: String,
        default: 'text'
    },
    placeholder: {
        type: String,
        default: ''
    },
    disabled: {
        type: Boolean,
        default: false
    },
    readonly: {
        type: Boolean,
        default: false
    },
    required: {
        type: Boolean,
        default: false
    },
    error: {
        type: String,
        default: ''
    },
    label: {
        type: String,
        default: ''
    },
    id: {
        type: String,
        default: ''
    },
    autocomplete: {
        type: String,
        default: 'off'
    },
    maxlength: {
        type: [String, Number],
        default: null
    },
    size: {
        type: String,
        default: 'md', // sm, md, lg
        validator: (value) => ['sm', 'md', 'lg'].includes(value)
    }
});

const emit = defineEmits(['update:modelValue', 'focus', 'blur', 'input', 'change']);

const isFocused = ref(false);

// Clases computadas para el input
const inputClasses = computed(() => [
    'w-full border rounded-xl transition-all duration-200 outline-none',
    'bg-white dark:bg-slate-800',
    'text-gray-900 dark:text-white',
    'placeholder-gray-400 dark:placeholder-gray-500',

    // Estados del borde
    props.error
        ? 'border-red-300 dark:border-red-600 focus:border-red-500 dark:focus:border-red-400 focus:ring-2 focus:ring-red-200 dark:focus:ring-red-900/30'
        : isFocused.value || props.modelValue
            ? 'border-blue-300 dark:border-blue-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/30'
            : 'border-gray-200 dark:border-slate-600 hover:border-gray-300 dark:hover:border-slate-500',

    // Tamaños
    props.size === 'sm' ? 'px-3 py-2 text-sm' : '',
    props.size === 'md' ? 'px-4 py-3 text-base' : '',
    props.size === 'lg' ? 'px-5 py-4 text-lg' : '',

    // Estados
    props.disabled ? 'opacity-50 cursor-not-allowed bg-gray-50 dark:bg-slate-900' : '',
    props.readonly ? 'cursor-default bg-gray-50 dark:bg-slate-900' : ''
]);

// Clases para el label
const labelClasses = computed(() => [
    'block text-sm font-medium mb-2',
    props.error
        ? 'text-red-600 dark:text-red-400'
        : 'text-gray-700 dark:text-gray-300'
]);

// Clases para el mensaje de error
const errorClasses = computed(() => [
    'mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-2'
]);

const handleInput = (event) => {
    emit('update:modelValue', event.target.value);
    emit('input', event);
};

const handleChange = (event) => {
    emit('change', event);
};

const handleFocus = (event) => {
    isFocused.value = true;
    emit('focus', event);
};

const handleBlur = (event) => {
    isFocused.value = false;
    emit('blur', event);
};

// ID único si no se proporciona
const inputId = computed(() => props.id || `input-${Math.random().toString(36).substr(2, 9)}`);
</script>

<template>
    <div class="w-full">
        <!-- Label -->
        <label
            v-if="label"
            :for="inputId"
            :class="labelClasses"
        >
            {{ label }}
            <span v-if="required" class="text-red-500 dark:text-red-400 ml-1">*</span>
        </label>

        <!-- Input -->
        <input
            :id="inputId"
            :type="type"
            :value="modelValue"
            :placeholder="placeholder"
            :disabled="disabled"
            :readonly="readonly"
            :required="required"
            :autocomplete="autocomplete"
            :maxlength="maxlength"
            :class="inputClasses"
            @input="handleInput"
            @change="handleChange"
            @focus="handleFocus"
            @blur="handleBlur"
        />

        <!-- Mensaje de error -->
        <div v-if="error" :class="errorClasses">
            <!-- Icono de error -->
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ error }}
        </div>
    </div>
</template>
