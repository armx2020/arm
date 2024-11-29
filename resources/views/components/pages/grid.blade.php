@php
    switch ($position) {
        case 1:
            $positionClass = 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5';
            break;
        case 2:
            $positionClass = 'grid grid-cols-1 gap-3 lg:gap-5';
            break;
        default:
        $positionClass = 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5';
            break;
    }
@endphp

<div class="{{ $positionClass }}">
    @foreach ($entities as $entity)
            <x-pages.card :entity="$entity" :$entityShowRout :$position/>
    @endforeach
</div>
