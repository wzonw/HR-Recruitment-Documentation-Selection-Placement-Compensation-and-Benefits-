@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 text-2xl font-bold text-indigo-800 shadow-md shadow-gray-200">
        {{ $title }}
    </div>

    <div class="px-6 py-4 text-sm text-gray-600">
        {{ $content }}
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
        {{ $footer }}
    </div>
</x-modal>
