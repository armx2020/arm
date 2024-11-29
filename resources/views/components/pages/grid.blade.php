@php
    switch ($position) {
        case 1:
            $positionClass = 'grid-cols-2 xl:grid-cols-3';
            break;
        case 2:
            $positionClass = 'grid-cols-1';
            break;
        default:
            $positionClass = 'grid-cols-2 xl:grid-cols-3';
            break;
    }
@endphp

<div class="grid {{ $positionClass }} gap-3 lg:gap-5">
    @foreach ($entities as $entity)
        @if ($position == 2)
            <x-pages.horizontal-card :entity="$entity" :$entityShowRout />
        @else
            <x-pages.vertical-card :entity="$entity" :$entityShowRout />
        @endif
    @endforeach
</div>
