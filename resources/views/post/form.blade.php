<div class="space-y-6">
    <!-- Campo Nombre -->
    <div>
        <x-input-label for="title" :value="__('Nombre')"/>
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title)" autocomplete="title" placeholder="Nombre"/>
        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
    </div>

    <!-- Campo Descripción -->
    <div>
        <x-input-label for="content" :value="__('Descripción')"/>
        <x-text-input id="content" name="content" type="text" class="mt-1 block w-full" :value="old('content', $post->content)" autocomplete="content" placeholder="Descripción"/>
        <x-input-error class="mt-2" :messages="$errors->get('content')"/>
    </div>

    <!-- Campo de Selección de Categoría -->
    <div>
        <x-input-label for="id_category" :value="__('Categoría')"/>
        <select id="id_category" name="id_category" class="mt-1 block w-full">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('id_category', $post->id_category) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('id_category')"/>
    </div>

    <!-- Botón Guardar -->
    <div class="flex items-center gap-4">
        <x-primary-button>Guardar</x-primary-button>
    </div>
</div>
