<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('POSTS') }}</h1>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a href="{{ route('posts.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Crear Post</a>
                        </div>
                    </div>

                    <div class="mt-4 sm:flex sm:items-center">
                        
                    <!-- Filtros -->
                    <form id="filter-form" method="GET" action="{{ route('posts.index') }}" class="flex flex-wrap gap-6 items-start">
                        <!-- Título -->
                        <div class="flex flex-col items-start w-48">
                            <label for="title" class="block text-xs font-semibold text-gray-500 mb-2">Título</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                value="{{ request()->get('title') }}" 
                                class="p-2 border rounded-md text-sm w-full" 
                                placeholder="Buscar título..."
                            >
                        </div>

                        <!-- Categoría -->
                        <div class="flex flex-col items-start w-48">
                            <label for="id_category" class="block text-xs font-semibold text-gray-500 mb-2">Categoría</label>
                            <select 
                                name="id_category" 
                                id="id_category" 
                                class="p-2 border rounded-md text-sm w-full"
                            >
                                <option value="">Todas</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request()->get('id_category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ordenar por -->
                        <div class="flex flex-col items-start w-48">
                            <label for="sort_field" class="block text-xs font-semibold text-gray-500 mb-2">Ordenar por</label>
                            <select 
                                name="sort_field" 
                                id="sort_field" 
                                class="p-2 border rounded-md text-sm w-full"
                            >
                                <option value="created_at" {{ request()->get('sort_field') == 'created_at' ? 'selected' : '' }}>Fecha</option>
                                <option value="title" {{ request()->get('sort_field') == 'title' ? 'selected' : '' }}>Título</option>
                            </select>
                        </div>

                        <!-- Orden -->
                        <div class="flex flex-col items-start w-48">
                            <label for="sort_order" class="block text-xs font-semibold text-gray-500 mb-2">Orden</label>
                            <select 
                                name="sort_order" 
                                id="sort_order" 
                                class="p-2 border rounded-md text-sm w-full"
                            >
                                <option value="desc" {{ request()->get('sort_order') == 'desc' ? 'selected' : '' }}>Descendente</option>
                                <option value="asc" {{ request()->get('sort_order') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                            </select>
                        </div>

                        <!-- Mostrar -->
                        <div class="flex flex-col items-start w-48">
                            <label for="per_page" class="block text-xs font-semibold text-gray-500 mb-2">Mostrar</label>
                            <select 
                                name="per_page" 
                                id="per_page" 
                                class="p-2 border rounded-md text-sm w-full"
                            >
                                <option value="10" {{ request()->get('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request()->get('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request()->get('per_page') == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </div>
                    </form>

                    </div>

                    <div class="flow-root mt-8">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">ID</th>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nombre</th>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Descripción</th>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Categoría</th>
                                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($posts as $post)
                                        <tr class="even:bg-gray-50">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $post->title }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $post->content }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $post->category ? $post->category->name : 'Sin categoría' }}</td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                    <a href="{{ route('posts.show', $post->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Ver') }}</a>
                                                    <a href="{{ route('posts.edit', $post->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900 mr-2">{{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('posts.destroy', $post->id) }}" class="text-red-600 font-bold hover:text-red-900" onclick="event.preventDefault(); confirm('¿Estas seguro que deseas eliminar el post?') ? this.closest('form').submit() : false;">{{ __('Eliminar') }}</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4 px-4">
                                    {!! $posts->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para filtros automáticos -->
    <script>
        document.querySelectorAll('#filter-form input, #filter-form select').forEach(element => {
            element.addEventListener('change', () => {
                document.getElementById('filter-form').submit();
            });
        });
    </script>
</x-app-layout>
