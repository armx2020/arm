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

        <div class="group relative w-72 h-72" wire:ignore>
            <div class="swiper mySwiper2 w-full h-full">
                <div class="swiper-wrapper">
                    @foreach($images as $image)
                        <div class="swiper-slide flex">
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
                   !w-[70px] !left-[50%] !translate-x-[-50%] text-center !text-white
                   bg-black/60 text-sm
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

        <!-- Слайдер миниатюр (thumbs) -->
        <div class="swiper mySwiper mt-2 w-72 h-22" wire:ignore>
            <div class="swiper-wrapper cursor-pointer">
                @foreach($images as $image)
                    <div class="swiper-slide">
                        <img class="w-full h-full object-cover rounded-lg" src="{{ asset('storage/'.$image->path) }}">
                    </div>
                @endforeach
            </div>
        </div>

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

    <div class="flex flex-col px-0 lg:px-6 mt-3 sm:mt-0 justify-start break-all">
        <h3 class="block text-left text-md font-semibold sm:mx-4">
            {{ mb_substr($entity->name, 0, 90, 'UTF-8') }}
        </h3>

        @if ($entity->description)
            <span class="sm:mx-4 text-sm font-semibold mt-4">Описание</span>
            <div class="max-h-16 md:max-h-36 lg:max-h-48 flex truncate sm:mx-4 max-w-[50rem]">
                <p
                    class="text-xs md:text-base font-normal text-gray-500 break-words whitespace-normal text-justify whitespace-pre-wrap">{{ $entity->description }}</p>
            </div>
        @endif

        @if ($entity->entity_type_id == 1)
            @if ($entity->fields && count($entity->fields) > 3)
                <span class="sm:mx-4 text-sm font-semibold mt-4">Деятельность</span>
                @foreach ($entity->fields as $category)
                    <p class="flex text-left text-sm sm:mx-4 text-gray-500 break-all">
                        &bull; {{ $category->name }}
                    </p>
                @endforeach
            @elseif ($entity->offers && count($entity->offers) > 0)
                <span class="sm:mx-4 text-sm font-semibold mt-4">Деятельность</span>
                @foreach ($entity->offers as $offer)
                    <p class="flex text-left text-sm sm:mx-4 text-gray-500 break-all">
                        &bull; {{ $offer->name }}
                    </p>
                @endforeach
            @endif
        @endif

        @if ($entity->city)
            <span class="sm:mx-4 text-sm mt-4">Город:</span>
            <p class="flex text-left text-sm sm:mx-4 my-1 text-gray-500 break-all">
                {{ mb_substr($entity->city->name, 0, 400, 'UTF-8') }}
            </p>
        @endif

        @if ($entity->address)
            <span class="sm:mx-4 text-sm mt-4">Адрес:</span>
            <p class="flex text-left text-sm sm:mx-4 my-1 text-gray-500 break-all">
                {{ mb_substr($entity->address, 0, 400, 'UTF-8') }}
            </p>
        @endif

        @if ($entity->phone)
            <span class="sm:mx-4 text-sm mt-4">Телефон:</span>
            <p class="flex text-left text-sm sm:mx-4 my-1 text-gray-500 break-all">
                {{ mb_substr($entity->phone, 0, 400, 'UTF-8') }}
            </p>
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
                            + ' из '
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
                    autoStart: false,
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
