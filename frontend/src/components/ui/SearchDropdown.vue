<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const isOpen = ref(false);
const selectedCategory = ref('Todas');
const searchQuery = ref('');
const dropdownRef = ref(null);

const categories = [
  { id: 1, name: 'Todas' },
  { id: 2, name: 'Motos Usadas' },
  { id: 3, name: 'Autos Usados' },
  { id: 4, name: 'Motos Nuevas' },
];

const selectCategory = (category) => {
  selectedCategory.value = category.name;
  isOpen.value = false;
};

const handleClickOutside = (event) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    isOpen.value = false;
  }
};

const handleSearch = () => {
  console.log('Realizando búsqueda:', {
    categoría: selectedCategory.value,
    término: searchQuery.value
  });
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
  <div class="w-full ">
    <div class="w-full">
      <div class="flex">
        <!-- Dropdown Categories -->
        <div class="relative" ref="dropdownRef">
          <button
              type="button"
              @click="isOpen = !isOpen"
              class="shrink-0 z-10 inline-flex items-center py-2.5 px-2 md:px-4 text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white dark:border-gray-600"
          >
            <span class="truncate text-sm  max-w-16 md:max-w-none">{{ selectedCategory }}</span>
            <ChevronDown />
          </button>

          <div v-if="isOpen" class="absolute top-full left-0 z-20 mt-1 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-32 md:w-44 dark:bg-gray-700">
            <ul class="py-1 md:py-2 text-xs md:text-sm text-gray-700 dark:text-gray-200">
              <li v-for="category in categories" :key="category.id">
                <button
                    type="button"
                    @click="selectCategory(category)"
                    class="text-sm inline-flex w-full px-3 md:px-4 py-1.5 md:py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                >
                  {{ category.name }}
                </button>
              </li>
            </ul>
          </div>
        </div>

        <!-- Search Input -->
        <div class="relative w-full">
          <input
              type="search"
              v-model="searchQuery"
              class="block py-2.5 px-2 md:p-2.5 w-full z-10 text-sm outline-none text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
              placeholder="Ej. Nissan March..."
          />
          <button
              @click="handleSearch"
              class="absolute cursor-pointer top-0 end-0 p-3 md:p-2.5 text-xs md:text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700"
          >
            <svg class="w-3 h-3 md:w-4 md:h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
            <span class="sr-only">Buscar</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
