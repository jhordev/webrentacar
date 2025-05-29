<script setup>
defineProps({
  label: String,
  modelValue: [String, Number],
  options: {
    type: Array,
    required: true
  },
  placeholder: {
    type: String,
    default: 'Seleccionar'
  },
  name: {
    type: String,
    default: ''
  }
})

defineEmits(['update:modelValue'])
</script>

<template>
  <div class="">
    <label :for="name" class="block text-[16px] uppercase font-medium text-gray-700 dark:text-white mb-4">{{ label }}</label>
    <select
        :id="name"
        :name="name"
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-4 py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
      <option value="">{{ placeholder }}</option>
      <option
          v-for="(opcion, index) in options"
          :key="index"
          :value="opcion.value"
      >
        {{ opcion.label }}
      </option>
    </select>
  </div>
</template>

<style scoped>
/* Opcional: estilos adicionales si quieres */
</style>
