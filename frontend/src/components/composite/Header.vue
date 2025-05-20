<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { RouterLink } from 'vue-router';
import SearchDropdown from '@/components/ui/SearchDropdown.vue';

const isMenuOpen = ref(false);
const isScrolled = ref(false);

const toggleMenu = () => (isMenuOpen.value = !isMenuOpen.value);
const closeMenu  = () => (isMenuOpen.value = false);

const handleEsc = e => e.key === 'Escape' && closeMenu();
const handleScroll = () => (isScrolled.value = window.scrollY > 0);

onMounted(() => {
    window.addEventListener('keydown', handleEsc);
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
});
onUnmounted(() => {
    window.removeEventListener('keydown', handleEsc);
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <header
        :class="[
            // base
            'py-4 lg:py-5 w-full fixed top-0 z-60 border-b transition-colors duration-300',
            // scroll state
            isScrolled
                ? 'backdrop-blur-md border-gray-600 bg-white/70 dark:bg-gray-900/50 shadow-sm'
                : 'bg-white dark:bg-gray-900 border-transparent',
            // menú abierto
            isMenuOpen ? 'border-transparent' : ''
        ]"
    >
        <div class="container-general flex items-center justify-between px-4 lg:px-6">
            <div class="hidden lg:flex items-center gap-6">
                <div class="flex items-center gap-1.5">
                    <img src="@/assets/vue.svg" class="w-8"/>
                    <span class="font-bold text-[20px] uppercase text-textColor dark:text-white">CarsMexico</span>
                </div>
                <SearchDropdown/>
            </div>

            <nav class="hidden lg:flex items-center gap-7">
                <RouterLink to="/" class="link-nav truncate max-w-32">Inicio</RouterLink>
                <RouterLink to="/" class="link-nav truncate max-w-32">Motos Usadas</RouterLink>
                <RouterLink to="/" class="link-nav truncate max-w-32">Autos Usados</RouterLink>
                <RouterLink to="/" class="link-nav truncate max-w-32">Motos Nuevas</RouterLink>
                <RouterLink to="/" class="link-nav truncate max-w-32 hidden lg:block">Sobre Nosotros</RouterLink>
                <RouterLink to="/" class="link-nav truncate max-w-32 hidden lg:block">Blog</RouterLink>
                <RouterLink to="/" class="btn-outline">Anúnciate</RouterLink>
            </nav>

            <div class="lg:hidden flex items-center gap-2">
                <img src="@/assets/vue.svg" class="w-6"/>
            </div>

            <div class="flex-1 mx-3 lg:hidden">
                <SearchDropdown/>
            </div>

            <button
                @click="toggleMenu"
                aria-label="Toggle Navigation Menu"
                class="lg:hidden p-1 z-60"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-textColor dark:text-white" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path v-if="!isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </header>

    <div
        v-if="isMenuOpen"
        class="fixed inset-0 bg-black/60 z-50"
        @click="closeMenu"
    ></div>

    <aside
        :class="[
            'fixed right-0 top-0 w-64 h-[calc(100vh-4rem)] transform transition-transform duration-300 z-56',
            isScrolled
                ? 'backdrop-blur-md border-b border-gray-600 bg-white/70 dark:bg-gray-900/50 shadow-sm'
                : 'bg-white dark:bg-gray-900 shadow-lg',
            isMenuOpen ? 'translate-x-0' : 'translate-x-full'
        ]"
        @click.stop
    >
        <nav class="pt-26 px-6 flex flex-col gap-6">
            <RouterLink to="/" class="link-nav" @click="closeMenu">Inicio</RouterLink>
            <RouterLink to="/" class="link-nav" @click="closeMenu">Motos Usadas</RouterLink>
            <RouterLink to="/" class="link-nav" @click="closeMenu">Autos Usados</RouterLink>
            <RouterLink to="/" class="link-nav" @click="closeMenu">Motos Nuevas</RouterLink>
            <RouterLink to="/" class="link-nav" @click="closeMenu">Sobre Nosotros</RouterLink>
            <RouterLink to="/" class="link-nav" @click="closeMenu">Blog</RouterLink>
            <RouterLink to="/" class="btn-outline mt-2 inline-block w-fit" @click="closeMenu">Anúnciate</RouterLink>
        </nav>
    </aside>
</template>

<style scoped>
</style>
