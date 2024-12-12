<div class="flex flex-row rounded-lg bg-white min-h-36 sm:min-h-64 p-2 sm:p-4 truncate relative">
    <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}">
        <img class="h-24 w-24 md:h-40 md:w-40 lg:h-48 lg:w-48 rounded-2xl object-cover rounded-2xl object-cover"
            src={{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/groups.png') }}
            alt="{{ $entity->name }}" />
    </a>
    <div class="px-2 lg:px-5 flex flex-col max-w-48 flex-1 truncate">
        <div class="flex truncate">
            <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}">
                <p class="mb-2 mt-2 sm:mt-0 text-xs md:text-base font-semibold leading-tight text-neutral-700 truncate">
                    {{ mb_substr($entity->name, 0, 1300, 'UTF-8') }}
                    @if (mb_strlen($entity->name) > 1300)
                        ...
                    @endif
                </p>
            </a>
        </div>

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

@if ($entity->city_id && $entity->city_id !== 1)
    <p
        class="mt-3 break-words text-xs lg:text-sm font-semibold text-blue-500 absolute top-24 sm:top-48 block lg:hidden">
        {{ $entity->city->name }}
    </p>
@endif

<div class="hidden lg:block absolute top-24 sm:top-40">
    <x-pages.social :entity=$entity />
</div>


</div>
<div class="hidden lg:flex flex-initial text-right flex flex-col">
<p class="text-sm mb-1">
    @isset($entity->phone)
        <a href="tel:{{ $entity->phone }}" class="text-blue-600">
            {{ $entity->phone }}
        </a>
    @endisset

    @if ($entity->city_id && $entity->city_id !== 1)
        <p class="break-words text-xs font-semibold text-blue-500 hidden lg:block">
            {{ $entity->city->name }}
        </p>
    @endif
</p>


</div>
</div>
