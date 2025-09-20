@props(['label', 'value', 'color' => 'indigo'])

<div class="rounded-xl bg-white shadow p-5 flex flex-col border-t-4 border-{{ $color }}-500">
    <span class="text-sm text-gray-500">{{ $label }}</span>
    <span class="mt-2 text-3xl font-bold text-gray-900">{{ $value }}</span>
</div>
