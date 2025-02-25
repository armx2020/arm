<section>
    <div class="flex flex-col mx-auto my-6 lg:my-8">

        <div class="flex flex-col sm:flex-row bg-white rounded-md p-3 lg:p-4 relative h-auto lg:min-h-80">

            <div class="flex sm:hidden pb-4 px-3 w-full justify-end">
                <a href="{{ url()->previous() }}" class="[&>svg]:fill-[#a1b4c2] w-3 h-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path
                            d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                    </svg>
                </a>
            </div>


            @php
                $images = $entity->images(true)->get();
            @endphp

    <div class="flex flex-col gap-2">

        @if($images->count() > 0)
        <div class="group relative max-w-full aspect-[16/11] sm:max-w-[320px] md:max-w-[380px] xl:max-w-[430px]" wire:ignore>
            <div class="swiper mySwiper2 w-full h-full">
                <div class="swiper-wrapper w-full h-full">
                    @foreach($images as $image)
                        <div class="swiper-slide flex w-full h-full">
                            <a data-fancybox="gallery" href="{{ asset('storage/'.$image->path) }}" class="w-full h-full">
                                <img class="w-full h-full object-cover rounded-lg" src="{{ asset('storage/'.$image->path) }}">
                            </a>
                        </div>
                    @endforeach
                </div>

                <div
                    class="swiper-pagination
                   absolute bottom-2 left-1/2
                   transform -translate-x-1/2
                   !w-[48px] h-6 !left-[50%] !translate-x-[-50%] text-center !text-white
                   bg-black/60 text-xs
                   rounded-full py-1"
                ></div>

                <div
                    class="swiper-button-prev
                   hidden group-hover:flex
                   items-center
                   absolute inset-y-0 left-2
                   text-white z-10"
                ></div>
                <div
                    class="swiper-button-next
                   hidden group-hover:flex
                   items-center
                   absolute inset-y-0 right-2
                   text-white z-10"
                ></div>
            </div>
        </div>

        <div class="swiper mySwiper mt-1 w-full sm:w-[320px] md:w-[380px] xl:w-[430px] h-22" wire:ignore>
            <div class="swiper-wrapper cursor-pointer">
                @foreach($images as $image)
                    <div class="swiper-slide">
                        <img class="w-full h-14 ms:h-16 ls:h-20 sm:h-16 md:h-20 object-cover rounded-lg" src="{{ asset('storage/'.$image->path) }}">
                    </div>
                @endforeach
            </div>
        </div>
        @else
            <div class="group relative max-w-full aspect-[16/11] sm:max-w-[320px] md:max-w-[380px] xl:max-w-[430px]" wire:ignore>
                <div class="w-full h-full">
                    <div class="swiper-slide flex w-full h-full">
                        <img class="w-full h-full object-cover rounded-lg" src="{{ url('/image/no_photo.jpg') }}">
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-between my-3 pl-0 text-xs text-blue-600">

            <a href="{{ route('entity.photo.edit', ['idOrTranscript' => $entity->id]) }}"
                class="whitespace-nowrap cursor-pointer flex text-center hover:text-blue-800">
                Добавить фото
            </a>

            <a href="{{ route('entity.edit', ['idOrTranscript' => $entity->id]) }}"
                class="whitespace-nowrap cursor-pointer flex text-center hover:text-blue-800">
                Исправить информацию
            </a>

        </div>

    </div>

    <div class="flex flex-col px-0 lg:px-6 mt-3 sm:mt-0 justify-start break-keep">
        <h3 class="block text-left text-md font-semibold sm:mx-4">
            {{ mb_substr($entity->name, 0, 90, 'UTF-8') }}
        </h3>

        @if ($entity->description)
            <span class="sm:mx-4 text-sm font-semibold mt-4 block">Описание</span>
            <div class="description-container relative max-w-prose sm:mx-4">
                <p class="description-content
                   text-base font-normal text-gray-700
                   break-keep whitespace-normal text-justify
                   overflow-hidden transition-all duration-300
                   line-clamp-5">
                {{ $entity->description }}
                </p>
                <div type="button" class="toggle-button absolute bottom-0 right-0 z-10 hidden cursor-pointer text-base focus:outline-none bg-white px-0">
                    <span>...</span>
                    <span class="hover:underline text-blue-600">Показать ещё</span>
                </div>
            </div>
        @endif

        @if ($entity->entity_type_id == 1)
            @if ($entity->fields && count($entity->fields) > 3)
                <span class="sm:mx-4 text-sm font-semibold mt-4">Деятельность</span>
                @foreach ($entity->fields as $category)
                    <p class="flex text-left text-sm sm:mx-4 text-gray-500 break-keep">
                        &bull; {{ $category->name }}
                    </p>
                @endforeach
            @elseif ($entity->offers && count($entity->offers) > 0)
                <span class="sm:mx-4 text-sm font-semibold mt-4">Деятельность</span>
                @foreach ($entity->offers as $offer)
                    <p class="flex text-left text-sm sm:mx-4 text-gray-500 break-keep">
                        &bull; {{ $offer->name }}
                    </p>
                @endforeach
            @endif
        @endif

        @if ($entity->city)
            <div class="flex items-center sm:mx-4 mt-4">
                <span class="text-sm">Город:</span>
                <p class="text-sm my-1 text-gray-500 break-keep ml-1">
                    {{ mb_substr($entity->city->name, 0, 400, 'UTF-8') }}
                </p>
            </div>
        @endif

        @if ($entity->address)
            <div class="flex items-center sm:mx-4 mt-4">
                <span class="text-sm">Адрес:</span>
                <p class="text-sm my-1 text-gray-500 break-keep ml-1">
                    {{ mb_substr($entity->address, 0, 400, 'UTF-8') }}
                </p>
            </div>
        @endif

        @if ($entity->phone)
            <div class="flex items-center sm:mx-4 mt-4">
                <span class="text-sm">Телефон:</span>
                <p class="masked-data phone text-sm my-1 text-gray-500 break-keep ml-1">
                    {{ mb_substr($entity->phone, 0, 400, 'UTF-8') }}
                </p>
            </div>
        @endif

        @if ($entity->web)
            <div class="flex items-center sm:mx-4 mt-4">
                <span class="text-sm">Сайт:</span>
                <a href="{{ mb_substr($entity->web, 0, 400, 'UTF-8') }}" class="text-sm my-1 text-gray-500 break-keep ml-1">
                    {{ mb_substr($entity->web, 0, 400, 'UTF-8') }}
                </a>
            </div>
        @endif

        <div class="my-3 sm:pl-4">
            <x-pages.social :entity=$entity />
        </div>

        <div class="flex space-x-2 my-3 pl-0 pl-0 sm:pl-4 max-w-[400px]">
            @php
                $message = null;
                if (isset($entity->whatsapp)) {
                    $message = $entity->whatsapp;
                } elseif (isset($entity->telegram)) {
                    $message = $entity->telegram;
                } elseif (isset($entity->phone)) {
                    $message = 'sms:' . $entity->phone . '?body=Привет!';
                }
            @endphp
            @if (isset($message))
                <a href="{{ $message }}"
                    class="whitespace-nowrap text-[clamp(10px, 4vw, 16px)] w-1/2 cursor-pointer inline-block bg-blue-400 hover:bg-blue-500 rounded-lg px-6 pb-2 pt-2.5 mt-1 text-center text-white">
                    Написать
                </a>
            @endif
            @if (isset($entity->phone))
                <a href="tel:{{ $entity->phone }}"
                    class="whitespace-nowrap text-[clamp(10px, 4vw, 16px)] w-1/2 cursor-pointer inline-block bg-green-400 hover:bg-green-500 rounded-lg px-6 pb-2 pt-2.5 mt-1 text-center text-white">
                    Позвонить
                </a>
            @endif
        </div>

        @role('super-admin')
            <div class="absolute right-4 bottom-1">
                <a href="{{ route('admin.entity.edit', ['entity' => $entity->id]) }}" class="[&>svg]:fill-[#a1b4c2]">
                    перейти в админ-панель
                </a>
            </div>
        @endrole

        <div class="hidden lg:block absolute right-4 w-4 h-4">

            @php
                switch ($entity->entity_type_id) {
                    // case 4:
                    //     $routeBack = null;
                    //     break;
                    // case 3:
                    //     $routeBack = null;
                    //     break;
                    // case 2:
                    //     $routeBack = null;
                    //     break;
                    default:
                        $routeBack = url()->previous();
                        break;
                }
            @endphp

            <a href="{{ $routeBack }}" class="[&>svg]:fill-[#a1b4c2]">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                </svg>
            </a>

        </div>

    </div>

</div>

</div>



@if ($entity->getTable() == 'companies')
    <x-pages.company-offers :$entity />
@endif
    <script>
        $(document).ready(function() {
            $('.masked-data').each(function() {
                var $element = $(this);
                var fullText = $.trim($element.text());
                var isPhone = $element.hasClass('phone');
                var threshold = isPhone ? 8 : 4;
                if (fullText.length <= threshold) {
                    return;
                }
                var maskedText = fullText.slice(0, threshold) + '********';
                $element.empty();
                var $maskedSpan = $('<span>').addClass('masked-part text-gray-500 mr-2').text(maskedText);
                var $fullSpan = $('<span>').addClass('full-part hidden text-gray-500 mr-2').text(fullText);
                var $button = $('<button>').addClass('show-full text-blue-500 hover:underline text-sm').text('Показать');
                $element.append($maskedSpan, $fullSpan, $button);
                $button.on('click', function(e) {
                    e.preventDefault();
                    $maskedSpan.addClass('hidden');
                    $fullSpan.removeClass('hidden');
                    $(this).remove();
                });
            });

            $('.description-container').each(function() {
                var $container = $(this);
                var $paragraph = $container.find('.description-content');
                var $toggleBtn = $container.find('.toggle-button');

                if ($paragraph[0].scrollHeight > $paragraph.outerHeight()) {
                    $toggleBtn.removeClass('hidden');
                }

                $toggleBtn.on('click', function() {
                    $paragraph.removeClass('line-clamp-5');
                    $toggleBtn.remove();
                });
            });

            let swiperThumbs = new Swiper(".mySwiper", {
                spaceBetween: 10,
                slidesPerView: 3,
                freeMode: true,
                watchSlidesProgress: true,
            });

            let swiperMain = new Swiper(".mySwiper2", {
                spaceBetween: 10,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    type: 'fraction',
                    renderFraction: (currentClass, totalClass) => {
                        return '<span class="' + currentClass + '"></span>'
                            + ' / '
                            + '<span class="' + totalClass + '"></span>';
                    }
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: swiperThumbs,
                },
            });

            Fancybox.bind("[data-fancybox='gallery']", {
                Thumbs: {
                    autoStart: true,
                },
                animated: false,
                showClass: "fancybox-fadeIn",
                hideClass: "fancybox-fadeOut",
            });

            Livewire.hook('message.processed', () => {
                swiperMain.update();
                swiperThumbs.update();
            });

        });

    </script>
    <style>
        .mySwiper .swiper-slide-thumb-active img {
            @apply border-2 border-indigo-600 rounded-lg;
            border: 2px solid #60A5FA;
            transition: transform 0.2s;
        }
        .mySwiper2 .swiper-button-next,
        .mySwiper2 .swiper-button-prev {
            opacity: 0;
            transition: opacity 0.2s;
        }

        .group:hover .swiper-button-next,
        .group:hover .swiper-button-prev {
            opacity: 1;
        }
    </style>
</section>
