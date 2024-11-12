<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Categorías') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('CATEGORIAS') }}</h1>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('categories.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Crear Categoria</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($categories as $category)
                                            <tr class="even:bg-gray-50">
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $category->id }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ $category->name }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ $category->description }}</td>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                        <a href="{{ route('categories.show', $category->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Ver') }}</a>
                                                        <a href="{{ route('categories.edit', $category->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900 mr-2">{{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('categories.destroy', $category->id) }}" class="text-red-600 font-bold hover:text-red-900" onclick="event.preventDefault(); confirm('¿Estás seguro que deseas eliminar la categoría?') ? this.closest('form').submit() : false;">{{ __('Eliminar') }}</a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
