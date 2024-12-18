<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Actividades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Registro de Actividades') }}</h1>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">ID</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Log Name</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Descripción</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Subject ID</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Subject Type</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Causer ID</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Causer Type</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Properties</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Batch UUID</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Event</th>
                                            <th class="py-3 px-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($activityLog as $activity)
                                            <tr class="even:bg-gray-50">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ $activity->id }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->log_name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->description }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->subject_id }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->subject_type }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->causer_id }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->causer_type }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <!-- Cuadro de texto grande para JSON formateado -->
                                                    <textarea readonly class="bg-gray-100 p-3 rounded-md w-full h-48 text-xs font-mono text-gray-700">{{ json_encode($activity->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</textarea>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->batch_uuid }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->event }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $activity->created_at->format('d/m/Y H:i') }}</td>
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
