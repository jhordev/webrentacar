<script setup>
import { ref, watch } from 'vue';
import { Search, ChevronDown } from 'lucide-vue-next';

const props = defineProps({ tipo: String });

const marca = ref('');
const modelo = ref('');
const añoDesde = ref('');
const añoHasta = ref('');
const precioDesde = ref('');
const precioHasta = ref('');
const modelos = ref([]);

const marcasPorTipo = {
    'Motos Usadas': ['Yamaha', 'Honda'],
    'Autos Usados': ['Toyota', 'Nissan', 'Ford', 'Chevrolet']
};

const modelosPorMarcaYTipo = {
    'Motos Usadas': {
        Yamaha: ['FZ', 'R15'],
        Honda: ['CBR', 'Wave']
    },
    'Autos Usados': {
        Toyota: ['Corolla', 'Yaris', 'RAV4'],
        Nissan: ['Sentra', 'Versa', 'Rogue'],
        Ford: ['Fiesta', 'Focus'],
        Chevrolet: ['Onix', 'Aveo']
    }
};

const añosDisponibles = Array.from({ length: 51 }, (_, i) => (new Date().getFullYear() - 50 + i).toString());

const preciosDisponibles = ['50,000', '100,000', '150,000', '200,000', '300,000', '500,000', '750,000', '1,000,000+'];

watch([marca, () => props.tipo], () => {
    modelo.value = '';
    if (marca.value && modelosPorMarcaYTipo[props.tipo]) {
        modelos.value = modelosPorMarcaYTipo[props.tipo][marca.value] || [];
    } else {
        modelos.value = [];
    }
});

const buscar = () => {
    console.log('BUSCANDO:', {
        tipo: props.tipo,
        marca: marca.value,
        modelo: modelo.value,
        añoDesde: añoDesde.value,
        añoHasta: añoHasta.value,
        precioDesde: precioDesde.value,
        precioHasta: precioHasta.value
    });
};
</script>

<template>
    <div class="bg-bgCard/80 dark:bg-bgCardDark/80 p-4 md:p-6 rounded-3xl shadow-sm">
        <div class="grid grid-cols-2 gap-4">
            <!-- Selector de Marca -->
            <div class="relative">
                <select
                    v-model="marca"
                    class="select-from"
                >
                    <option disabled value="">Marca</option>
                    <option v-for="m in marcasPorTipo[props.tipo]" :key="m" :value="m" class="text-textColor">{{ m }}</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <ChevronDown class="w-5 h-5 text-gray-400" />
                </div>
            </div>

            <!-- Selector de Modelo -->
            <div class="relative">
                <select
                    v-model="modelo"
                    class="select-from"
                    :disabled="!modelos.length"
                >
                    <option disabled value="">Modelo</option>
                    <option v-for="mod in modelos" :key="mod" :value="mod" class="text-textColor">{{ mod }}</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <ChevronDown class="w-5 h-5 text-gray-400" />
                </div>
            </div>

            <!-- Selector Año Desde -->
            <div class="relative">
                <select
                    v-model="añoDesde"
                    class="select-from"
                >
                    <option disabled value="">Año desde</option>
                    <option v-for="año in añosDisponibles" :key="año" :value="año" class="text-textColor">{{ año }}</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <ChevronDown class="w-5 h-5 text-gray-400" />
                </div>
            </div>

            <!-- Selector Año Hasta -->
            <div class="relative">
                <select
                    v-model="añoHasta"
                    class="select-from"
                >
                    <option disabled value="">Año hasta</option>
                    <option v-for="año in añosDisponibles.filter(a => !añoDesde || a >= añoDesde)" :key="año" :value="año" class="text-textColor">{{ año }}</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <ChevronDown class="w-5 h-5 text-gray-400" />
                </div>
            </div>

            <!-- Selector Precio Desde -->
            <div class="relative">
                <select
                    v-model="precioDesde"
                    class="select-from"
                >
                    <option disabled value="">Precio desde</option>
                    <option v-for="precio in preciosDisponibles" :key="precio" :value="precio" class="text-textColor">${{ precio }}</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <ChevronDown class="w-5 h-5 text-gray-400" />
                </div>
            </div>

            <!-- Selector Precio Hasta -->
            <div class="relative">
                <select
                    v-model="precioHasta"
                    class="select-from"
                >
                    <option disabled value="">Precio hasta</option>
                    <option
                        v-for="precio in preciosDisponibles.filter(p => !precioDesde || preciosDisponibles.indexOf(p) >= preciosDisponibles.indexOf(precioDesde))"
                        :key="precio"
                        :value="precio"
                        class="text-textColor"
                    >
                        ${{ precio }}
                    </option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <ChevronDown class="w-5 h-5 text-gray-400" />
                </div>
            </div>
        </div>

        <!-- Botón Buscar -->
        <div class="mt-4">
            <button
                @click="buscar"
                class="w-full cursor-pointer bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg flex items-center justify-center transition-colors"
            >
                <Search class="mr-2.5" />
                Buscar {{ props.tipo }}
            </button>
        </div>
    </div>
</template>
