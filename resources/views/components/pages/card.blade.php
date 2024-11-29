@php
    switch ($position) {
        case 1:
            $flex = 'flex flex-col rounded-lg bg-white h-80';
            $aClass = 'flex';
            $imageClass = 'h-48 w-full rounded-2xl p-2 flex object-cover';
            $bodyClass = 'px-3 md:px-6';
            break;
        case 2:
            $flex = 'flex flex-col sm:flex-row rounded-lg bg-white h-auto sm:h-64';
            $aClass = 'w-full sm:basis-1/3';
            $imageClass = 'h-full w-full rounded-2xl p-2 flex object-cover';
            $bodyClass = 'p-6 flex flex-col w-full sm:basis-2/3';
            break;
        default:
            $flex = 'flex flex-col rounded-lg bg-white h-80';
            $aClass = 'flex';
            $imageClass = 'h-48 w-full rounded-2xl p-2 flex object-cover';
            $bodyClass = 'px-3 md:px-6';
            break;
    }
@endphp

<div class="{{ $flex }}">
    <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}" class="{{ $aClass }}">
        <img class="{{ $imageClass }} w-full rounded-2xl p-2 flex object-cover"
            src={{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/no-image.png') }}
            alt="image" />
    </a>
    <div class="{{ $bodyClass }}">
        <div class="">
            <h5 class="mb-2 break-words text-lg font-medium leading-tight text-neutral-800">
                {{ $entity->name }}
            </h5>
        </div>

        @isset($entity->description)
            <div>
                <p class="mb-2 break-words text-xs  font-medium leading-tight text-neutral-600 line-clamp-3">
                    {{ $entity->description }}
                </p>
            </div>
        @endisset

        @if ($position == 2 && isset($entity->categories))
            <div class="my-2">
                @foreach ($entity->categories as $categories)
                    <p class="break-words text-sm leading-tight text-neutral-600 line-clamp-3">
                        {{ $categories->name }}
                    </p>
                @endforeach
            </div>
        @endif

    </div>
</div>
