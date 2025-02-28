<div class="text-2xl font-medium mb-3">Другие</div>

<div class="grid grid-cols-1 ls:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($otherEntities as $entity)
        <div class="rounded-lg bg-white p-2 md:p-4 relative drop-shadow-sm hover:drop-shadow-md flex flex-col"
             id="{{ $entity->id }}_card">

            <a href="{{ route($entityShowRoute, ['idOrTranscript' => $entity->id]) }}">
                <img class="mx-auto aspect-[15/10] w-full rounded-lg object-cover"
                     @if(isset($entity->images()->get()[0]))
                     src="{{ asset('storage/' . $entity->images()->get()[0]->path) }}"
                     @else
                     src="{{ url('/image/no_photo.jpg') }}"
                     @endif
                     alt="{{ $entity->name }}"
                />
            </a>

            <div class="mt-3">
                <a href="{{ route($entityShowRoute, ['idOrTranscript' => $entity->id]) }}">
                    <h2 class="text-xs md:text-base lg:text-xl font-bold leading-tight text-neutral-700 break-words line-clamp-2">
                        {{ $entity->name }}
                    </h2>
                </a>
            </div>

            @if ($entity->entity_type_id !== 1)
                <div class="mt-2">
                    <p class="text-xs md:text-base font-normal text-gray-500 whitespace-normal break-words text-justify line-clamp-5">
                        {{ $entity->description }}
                    </p>
                </div>
            @endif

            @if ($entity->entity_type_id == 1)
                <div class="hidden lg:block mt-2">
                    <p class="text-xs md:text-base font-normal text-gray-500 break-words whitespace-normal text-justify">
                        {{ $entity->description }}
                    </p>
                </div>
            @endif

            @if ($entity->entity_type_id == 1)
                <div class="mt-2">
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
                <div class="mt-2">
                    <p class="text-xs font-medium text-blue-500 break-words">
                        {{ $entity->city->name }}
                    </p>
                </div>
            @endif

            <div class="mt-2">
                <x-pages.social :entity="$entity" />
            </div>

            <div class="mt-auto pt-3 text-right">
                @if($entity->phone && $entity->phone != '')
                    @php
                        $phoneFull = trim($entity->phone);
                        $VISIBLE_COUNT = 8;
                        if (mb_strlen($phoneFull) <= $VISIBLE_COUNT) {
                            $phoneMasked = $phoneFull;
                        } else {
                            $phoneMasked = mb_substr($phoneFull, 0, $VISIBLE_COUNT, 'UTF-8');
                        }
                    @endphp

                    <div class="flex items-center justify-end gap-1">
                        <a href="tel:{{ $phoneFull }}" data-phone="{{ $phoneFull }}" class="full-phone text-blue-600 whitespace-nowrap font-medium">
                            {{ $phoneMasked }}
                        </a>
                        <button type="button" class="show-phone font-medium text-blue-600 hover:underline text-sm whitespace-nowrap">
                            Показать
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        $(document).on('click', '.show-phone', function(e) {
            e.preventDefault();
            const $link = $(this).siblings('.full-phone');
            const phoneFull = $link.data('phone');
            $link.text(phoneFull);
            $(this).remove();
        });

        @foreach($otherEntities as $entity)
        $('#{!! $entity->id !!}_card').on('click', function() {
            const mobileWidthMediaQuery = window.matchMedia('(max-width: 768px)');
            if (mobileWidthMediaQuery.matches) {
                window.location.href = "{!! route($entityShowRoute, ['idOrTranscript' => $entity->id]) !!}";
            }
        });
        @endforeach
    });
</script>
