@php
    switch ($position) {
        case 2:
            $flex = 'flex flex-row rounded-lg bg-white h-36 sm:h-64';
            $aClass = 'basis-1/4 flex-none';
            $imageClass = 'h-full w-full rounded-2xl flex object-cover';
            $bodyClass = 'px-2 lg:px-5 flex flex-col basis-3/4 sm:basis-full max-w-48 grow-0 flex-1';
            $infoClass = 'hidden lg:flex sm:basis-1/4 flex-initial text-right';
            break;
    }
@endphp

<div class="{{ $flex }} p-2 sm:p-4 truncate">
    <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}" class="{{ $aClass }}">
        <img class="{{ $imageClass }} w-full rounded-2xl flex object-cover"
            src={{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/groups.png') }}
            alt="{{ $entity->name }}" />
    </a>
    <div class="{{ $bodyClass }} truncate">
        <div class="flex ">
            <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}">
                <p
                    class="mb-2 mt-2 sm:mt-0 text-xs md:text-md font-semibold leading-tight text-neutral-700 truncate">
                    {{ mb_substr($entity->name, 0, 1300, 'UTF-8') }}
                    @if (mb_strlen($entity->name) > 1300)
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
                <div class="my-2 hidden lg:flex">
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
            <div class="my-2 hidden lg:flex">
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

@if ($entity->city_id && $entity->city_id !== 1)
    <p class="mt-3 break-words text-xs lg:text-sm font-semibold text-blue-500">
        {{ $entity->city->name }}
    </p>
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


</div>
</div>
