<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <h2 class="text-xl font-bold text-gray-700 dark:text-white">¡Bienvenido, {{ auth()->user()->name }}!</h2>
        </x-slot>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow">
                   <div class="flex gap-1  items-center">
                       <x-filament::icon
                           icon="heroicon-s-users"
                           class="h-6 w-6 text-gray-500 dark:text-gray-400"
                       />
                       <h3 class="text-gray-700 dark:text-white text-lg font-semibold">Usuarios registrados</h3>
                   </div>
                    <p class="text-3xl mt-2 font-bold text-yellow-400">{{ \App\Models\User::count() }}</p>
            </div>

            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow">
                <div class="flex gap-1  items-center">
                    <x-filament::icon
                        icon="heroicon-o-megaphone"
                        class="h-6 w-6 text-gray-500 dark:text-gray-400"
                    />
                    <h3 class="text-gray-700 dark:text-white text-lg font-semibold">Total de Anuncios</h3>
                </div>
                <p class="text-3xl mt-2 font-bold text-yellow-400">150</p>
            </div>

            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow">
                <div class="flex gap-1  items-center">
                    <x-filament::icon
                        icon="heroicon-o-megaphone"
                        class="h-6 w-6"
                    />
                    <h3 class="text-gray-700 dark:text-white text-lg font-semibold">Anuncios Activos</h3>
                </div>
                <p class="text-3xl mt-2 font-bold text-yellow-400">150</p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
