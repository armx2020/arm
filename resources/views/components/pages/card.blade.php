<div class="flex flex-row rounded-lg bg-white h-36 md:h-64 lg:h-80 p-2 sm:p-4 relative drop-shadow-sm hover:drop-shadow-md"
    id="{{ $entity->id }}_card">
    <a href="{{ route($entityShowRout, ['idOrTranscript' => $entity->id]) }}">
        <img class="h-32 w-32 min-h-32 min-w-32 md:h-56 md:w-56 md:min-h-56 md:min-w-56 lg:h-72 lg:w-72 lg:min-h-72 lg:min-w-72 rounded-lg object-cover"
        @if(isset($entity->images()->get()[0])) src={{ asset('storage/' . $entity->images()->get()[0]->path) }}
        @else src={{ url('/image/groups.png') }} 
        @endif
            alt="{{ $entity->name }}" />
    </a>
    <div class="px-3 lg:px-5 flex flex-col flex-1">
        <div class="flex max-h-8 overflow-hidden mb-2">
            <a href="{{ route($entityShowRout, ['idOrTranscript' => $entity->id]) }}">
                <p
                    class="text-xs md:text-base lg:text-xl font-bold leading-tight text-neutral-700 break-words text-ellipsis overflow-hidden">
                    {{ $entity->name }}
                </p>
            </a>
        </div>

        @if ($entity->entity_type_id !== 1)
            <div class="max-h-16 md:max-h-36 lg:max-h-48 flex truncate">
                <p class="text-xs md:text-base font-normal text-gray-500 break-words whitespace-normal text-justify">
                    {{ $entity->description }}
                </p>
            </div>
        @endif

        @if ($entity->entity_type_id == 1)
            <div class="hidden lg:block max-h-12 md:max-h-[4.5rem] flex truncate mb-2">
                <p class="text-xs md:text-base font-normal text-gray-500 break-words whitespace-normal text-justify">
                    {{ $entity->description }}
                </p>
            </div>
        @endif

        @if ($entity->entity_type_id == 1)
            <div class="max-h-16 md:max-h-36 lg:max-h-48 flex truncate">
                @php
                    $count = 0;
                @endphp

                <ul class="list-disc text-base font-normal text-gray-500 break-all ml-4">
                    @if ($entity->fields)
                        @foreach ($entity->fields as $field)
                            <li class="text-xs lg:text-base">
                                {{ $field->name }}
                            </li>

                            @php
                                $count++;

                                if ($loop->iteration == 6) {
                                    break;
                                }
                            @endphp
                        @endforeach
                    @endif

                    @if ($count <= 6 && $entity->offers)
                        @foreach ($entity->offers as $offer)
                            <li class="text-xs lg:text-base">
                                {{ $offer->name }}
                            </li>

                            @php
                                $count++;

                                if ($count == 6) {
                                    break;
                                }
                            @endphp
                        @endforeach
                    @endif
                </ul>
            </div>
        @endif

        @if ($entity->city_id && $entity->city_id !== 1)
            <div class="max-h-4 mb-0 md:max-h-36 lg:max-h-48  break-words overflow-hidden">
                <p
                    class="mt-3 break-words text-xs font-medium text-blue-500 absolute top-[6.5rem] sm:top-[13.5rem] block lg:hidden">
                    {{ strtok($entity->city->name, ' ') }}
                </p>
            </div>
        @endif

        <div class="hidden lg:block absolute top-24 sm:top-[17.5rem]">
            <x-pages.social :entity=$entity />
        </div>

    </div>

    @if (isset($entity->phone) || $entity->city_id !== 1)
        <div class="hidden xl:flex flex-initial text-right flex flex-col w-44 text-wrap whitespace-normal">
            <p class="mb-1 font-medium">
                @isset($entity->phone)
                    <a href="tel:{{ $entity->phone }}" class="text-blue-600">
                        {{ $entity->phone }}
                    </a>
                @endisset

                @if ($entity->city_id && $entity->city_id !== 1)
                    <p class="break-words font-medium text-blue-500 hidden lg:block">
                        {{ $entity->city->name }}
                    </p>
                @endif
            </p>
        </div>
    @endif
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        $('#{!! $entity->id !!}_card').on('click', function() {
            const mobileWidthMediaQuery = window.matchMedia('(max-width: 768px)')

            if (mobileWidthMediaQuery.matches) {
                window.location.href = "{!! route($entityShowRout, ['idOrTranscript' => $entity->id]) !!}";
            }
        });

    });
</script>
