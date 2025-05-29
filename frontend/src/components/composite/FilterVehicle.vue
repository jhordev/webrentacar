<script setup>
import { ref } from 'vue'
import SelectFiltro from '@/components/ui/SelectFiltro.vue'
import RangeSlider   from '@/components/ui/RangeSlider.vue'

/* ---------------- selects ---------------- */
const categoria  = ref('')
const categorias = [
    { label: 'Motos usadas',  value: 'motos_usadas'  },
    { label: 'Autos usados',  value: 'autos_usados'  },
    { label: 'Motos nuevas',  value: 'motos_nuevas'  },
]

/* --------------- sliders ----------------- */
const rangoPrecio = ref({ min: 500,  max: 3000 })
const rangoAnio   = ref({ min: 1970, max: 2025 })

/* ------------- callbacks ----------------- */
const onRangoPrecio = (v) => {
    // aquí puedes usar el rango para filtrar resultados o llamar a tu API
    console.log('Nuevo rango de precio:', v)
}
</script>

<template>
    <div class="space-y-6">
        <!-- categoría -->
        <SelectFiltro
            label="Categoría"
            name="categoria"
            v-model="categoria"
            :options="categorias"
            placeholder="Selecciona una categoría"
        />

        <!-- rango de precio -->
        <RangeSlider
            v-model="rangoPrecio"
            :min="100"
            :max="5000"
            :step="50"
            label="Rango de precio"
            currency="€"
            name="rango_precio"
            @change="onRangoPrecio"
        />

        <!-- rango de años -->
        <RangeSlider
            v-model="rangoAnio"
            :min="1970"
            :max="2025"
            :step="1"
            label="Rango de años"
            name="rango_anio"
        />
    </div>
</template>

<style scoped>
/* Nada por ahora */
</style>
