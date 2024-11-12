<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Categoría') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-6">
                    <!-- Mostrar mensaje de éxito -->
                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formulario para crear nueva categoría -->
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="space-y-6">
                            <!-- Campo de nombre de categoría -->
                            <div>
                                <x-input-label for="name" :value="__('Nombre de la Categoría')" />
                                <x-text-input 
                                    id="name" 
                                    name="name" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    placeholder="Nombre de la categoría" 
                                    required 
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <!-- Campo descripción -->
                            <div>
                                <x-input-label for="description" :value="__('Descripción de la Categoría')" />
                                <x-text-input 
                                    id="description" 
                                    name="description" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    placeholder="Descripción de la Categoría" 
                                    required 
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <!-- Botón para crear la categoría -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>Crear Categoría</x-primary-button>
                            </div>
                        </div>
                    </form>

                    <!-- Enlace para regresar a la página anterior -->
                    <div class="mt-4">
                    <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
