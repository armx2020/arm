@php
    $fullness = 0;

    if ($entity->donations_have > 0 && $entity->donations_need > 0) {
        $fullness = round(($entity->donations_have * 100) / $entity->donations_need);
    }

@endphp

<div class="m-5">
    <div class="mb-1 text-lg font-medium">{{ $entity->donations_need }} руб.</div>
    <div class="w-full h-4 mb-4 bg-gray-200 rounded-full">
        <div class="h-4 bg-blue-600 rounded-full" style="width: {{ $fullness }}%"></div>
    </div>
</div>
