<div class="flex flex-row rounded-lg bg-white h-36 md:h-64 lg:h-80 p-2 sm:p-4 truncate relative">
    <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}">
        <img class="h-32 w-32 md:h-56 md:w-56 lg:h-72 lg:w-72 rounded-lg object-cover"
            src={{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/groups.png') }}
            alt="{{ $entity->name }}" />
    </a>
    <div class="px-3 lg:px-5 flex flex-col max-w-48 flex-1 truncate">
        <div class="flex truncate">
            <a href="{{ route($entityShowRout, ['id' => $entity->id]) }}">
                <p
                    class="mb-2 mt-2 sm:mt-0 text-xs md:text-base lg:text-xl font-bold leading-tight text-neutral-700 truncate">
                    {{ mb_substr($entity->name, 0, 1300, 'UTF-8') }}
                    @if (mb_strlen($entity->name) > 1300)
                        ...
                    @endif
                </p>
            </a>
        </div>

        @if ($entity->getTable() == 'groups')
            <div class="hidden lg:block">
                <p class="mb-2 mt-2 sm:mt-0 text-xs md:text-base text-base font-normal text-gray-500 break-words whitespace-normal text-justify">
                    {{ mb_substr($entity->description, 0, 400, 'UTF-8') }}
                    @if (mb_strlen($entity->description) > 400)
                        ...
                    @endif
                </p>
            </div>
        @endif

        @if ($entity->getTable() == 'companies')

            @php
                $count = 0;
            @endphp

            <ul class="list-disc text-base font-normal text-gray-500 break-all ml-4">
                @if ($entity->categories)
                    @foreach ($entity->categories as $category)
                        <li class="text-base">
                            {{ $category->name }}
                        </li>

                        @php
                            $count++;

                            if ($loop->iteration == 3) {
                                break;
                            }
                        @endphp
                    @endforeach
                @endif

                @if ($count <= 3 && $entity->offers)
                    @foreach ($entity->offers as $offer)
                        <li class="text-base">
                            {{ $offer->name }}
                        </li>

                        @php
                            $count++;

                            if ($count == 3) {
                                break;
                            }
                        @endphp
                    @endforeach
                @endif
            </ul>
        @endif

        @if ($entity->city_id && $entity->city_id !== 1)
            <p class="mt-3 break-words text-xs font-medium text-blue-500 absolute top-24 sm:top-48 block lg:hidden">
                {{ $entity->city->name }}
            </p>
        @endif

        <div class="hidden lg:block absolute top-24 sm:top-40">
            <x-pages.social :entity=$entity />
        </div>

    </div>

    <div class="hidden lg:flex flex-initial text-right flex flex-col">
        <p class="text-lg mb-1 font-medium">
            @isset($entity->phone)
                <a href="tel:{{ $entity->phone }}" class="text-blue-600">
                    {{ $entity->phone }}
                </a>
            @endisset

            @if ($entity->city_id && $entity->city_id !== 1)
                <p class="break-words text-lg font-medium text-blue-500 hidden lg:block">
                    {{ $entity->city->name }}
                </p>
            @endif
        </p>


    </div>
</div>
