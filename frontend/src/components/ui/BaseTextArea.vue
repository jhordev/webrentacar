<!-- BaseTextArea.vue -->
<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
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
    rows: {
        type: [String, Number],
        default: 4
    },
    cols: {
        type: [String, Number],
        default: null
    },
    maxlength: {
        type: [String, Number],
        default: null
    },
    minlength: {
        type: [String, Number],
        default: null
    },
    resize: {
        type: String,
        default: 'vertical',
        validator: (value) => ['none', 'both', 'horizontal', 'vertical'].includes(value)
    },
    size: {
        type: String,
        default: 'md', // sm, md, lg
        validator: (value) => ['sm', 'md', 'lg'].includes(value)
    },
    showCounter: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['update:modelValue', 'focus', 'blur', 'input', 'change']);

const isFocused = ref(false);

// Clases computadas para el textarea
const textareaClasses = computed(() => [
    'w-full border rounded-xl transition-all duration-200 outline-none',
    'bg-white dark:bg-slate-800',
    'text-gray-900 dark:text-white',
    'placeholder-gray-400 dark:placeholder-gray-500',

    // Resize
    props.resize === 'none' ? 'resize-none' : '',
    props.resize === 'horizontal' ? 'resize-x' : '',
    props.resize === 'vertical' ? 'resize-y' : '',
    props.resize === 'both' ? 'resize' : '',

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

// Clases para el contador de caracteres
const counterClasses = computed(() => {
    const current = props.modelValue?.toString().length || 0;
    const isNearLimit = props.maxlength && current >= props.maxlength * 0.8;
    const isOverLimit = props.maxlength && current > props.maxlength;

    return [
        'mt-2 text-xs flex justify-between items-center',
        isOverLimit
            ? 'text-red-600 dark:text-red-400'
            : isNearLimit
                ? 'text-orange-600 dark:text-orange-400'
                : 'text-gray-500 dark:text-gray-400'
    ];
});

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
const textareaId = computed(() => props.id || `textarea-${Math.random().toString(36).substr(2, 9)}`);

// Contador de caracteres
const characterCount = computed(() => props.modelValue?.toString().length || 0);
</script>

<template>
    <div class="w-full">
        <!-- Label -->
        <label
            v-if="label"
            :for="textareaId"
            :class="labelClasses"
        >
            {{ label }}
            <span v-if="required" class="text-red-500 dark:text-red-400 ml-1">*</span>
        </label>

        <!-- TextArea -->
        <textarea
            :id="textareaId"
            :value="modelValue"
            :placeholder="placeholder"
            :disabled="disabled"
            :readonly="readonly"
            :required="required"
            :rows="rows"
            :cols="cols"
            :maxlength="maxlength"
            :minlength="minlength"
            :class="textareaClasses"
            @input="handleInput"
            @change="handleChange"
            @focus="handleFocus"
            @blur="handleBlur"
        ></textarea>

        <!-- Contador de caracteres -->
        <div v-if="showCounter || maxlength" :class="counterClasses">
            <div></div>
            <div class="flex items-center gap-2">
        <span v-if="showCounter || maxlength">
          {{ characterCount }}{{ maxlength ? `/${maxlength}` : '' }}
        </span>
                <!-- Icono de advertencia si se acerca al límite -->
                <svg
                    v-if="maxlength && characterCount >= maxlength * 0.8"
                    class="w-4 h-4"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

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
