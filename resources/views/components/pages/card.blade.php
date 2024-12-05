@php
    switch ($position) {
        case 1:
            $flex = 'flex flex-col rounded-lg bg-white h-80';
            $aClass = 'flex';
            $imageClass = 'h-48 w-full rounded-2xl flex object-cover';
            $bodyClass = 'px-3 md:px-6';
            $infoClass = '';
            break;
        case 2:
            $flex = 'flex flex-col sm:flex-row rounded-lg bg-white h-auto sm:h-64';
            $aClass = 'sm:basis-1/4 flex-none';
            $imageClass = 'h-full w-full rounded-2xl flex object-cover';
            $bodyClass = 'px-3 flex flex-col sm:basis-full';
            $infoClass = 'sm:basis-1/4 flex-initial text-right';
            break;
        default:
            $flex = 'flex flex-col rounded-lg bg-white h-80';
            $aClass = 'flex';
            $imageClass = 'h-48 w-full rounded-2xl flex object-cover';
            $bodyClass = 'px-3 md:px-6';
            $infoClass = '';
            break;
    }
@endphp

<div class="{{ $flex }} p-4">
    <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}" class="{{ $aClass }}">
        <img class="{{ $imageClass }} w-full rounded-2xl flex object-cover"
            src={{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/groups.png') }}
            alt="{{ $entity->name }}" />
    </a>
    <div class="{{ $bodyClass }}">
        <div class="flex max-h-18">
            <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}">
                <p
                    class="mb-2 mt-2 sm:mt-0 break-words text-lg font-medium leading-tight text-neutral-800 text-ellipsis overflow-hidden">
                    {{ mb_substr($entity->name, 0, 130, 'UTF-8') }}
                    @if (mb_strlen($entity->name) > 130)
                        ...
                    @endif
                </p>
            </a>
        </div>

        @isset($entity->description)
            <p class="mb-2 break-words text-xs font-medium text-neutral-600">
                {{ mb_substr($entity->description, 0, 350, 'UTF-8') }}
                @if (mb_strlen($entity->description) > 350)
                    ...
                @endif
            </p>
        @endisset

        @if ($position == 2)
            @if (isset($entity->offers))
                <div class="my-2">
                    @foreach ($entity->offers as $offers)
                        <p class="break-words text-sm leading-tight text-neutral-600 line-clamp-3">
                            {{ $offers->name }}
                        </p>
                        @if ($loop->iteration == 3)
                        @break
                    @endif
                @endforeach
            </div>
        @elseif(isset($entity->categories))
            <div class="my-2">
                @foreach ($entity->categories as $category)
                    <p class="break-words text-sm leading-tight text-neutral-600 line-clamp-3">
                        {{ $category->name }}
                    </p>
                    @if ($loop->iteration == 3)
                    @break
                @endif
            @endforeach
        </div>
    @endif
@endif

</div>
<div class="{{ $infoClass }} flex flex-col">
<p class="text-sm mb-1">
    @isset($entity->phone)
        <a href="tel:{{ $entity->phone }}" class="text-blue-600">
            {{ $entity->phone }}
        </a>
    @endisset
</p>
<p class="text-xs">
    @if ($entity->city_id !== 1 && $entity->city)
        {{ $entity->city->name }}
    @endif
</p>

</div>
</div>
