<script setup>
import { ref } from 'vue'
import { Search } from '@element-plus/icons-vue'

const value = ref('')
const input3 = ref('')
const select = ref('')

const options = [
    {
        value: 'Option1',
        label: 'Option1',
    },
    {
        value: 'Option2',
        label: 'Option2',
    },
    {
        value: 'Option3',
        label: 'Option3',
    },
    {
        value: 'Option4',
        label: 'Option4',
    },
    {
        value: 'Option5',
        label: 'Option5',
    },
]
</script>

<template>
    <header class="py-5">
        <div class="container-general flex items-center justify-between">
            <div class="flex gap-6 items-center">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-gray-500 rounded-full"></div>
                    <span class="font-bold text-[20px] uppercase">CarMexico.mx</span>
                </a>

                <!-- Buscador -->
                <div>
                    <el-input
                        v-model="input3"
                        placeholder="Buscar..."
                        class="max-w-[337px] h-[47px]"
                    >
                        <!-- ahora el select va a la izquierda -->
                        <template #prepend>
                            <el-select v-model="select" placeholder="Todas" style="width: 100px">
                                <el-option label="Autos usados" value="1" />
                                <el-option label="Motos usadas" value="2" />
                                <el-option label="Motos nuevas" value="3" />
                            </el-select>
                        </template>
                        <template #append >
                            <el-button :icon="Search"  />
                        </template>
                    </el-input>
                </div>
            </div>

            <!-- Navegación -->
            <nav class="flex flex-row items-center gap-[30px]">
                <a href="/" class="nav-link">Inicio</a>
                <a href="/" class="nav-link">Motos Usadas</a>
                <a href="/" class="nav-link">Autos Usados</a>
                <a href="/" class="nav-link">Motos Nuevas</a>
                <a href="/" class="nav-link">Sobre nosotros</a>
                <a href="/" class="nav-link">Blog</a>

                <a href="/" class="py-2 px-6 border text-textColor hover:text-white border-blueOscuro hover:border-principalcolor rounded-2xl font-semibold text-[14px] hover:bg-principalcolor transition-colors duration-300 ease-in-out">Anunciate</a>
            </nav>
        </div>
    </header>
</template>

<style scoped>
/* Puedes agregar estilos si lo necesitas */
</style>
