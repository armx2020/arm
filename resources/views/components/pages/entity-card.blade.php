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

            <div class="flex flex-col gap-2">

                <div class="flex">
                    <img src="{{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/groups.png') }}"
                        class="h-[11rem] w-[27rem] lg:h-72 lg:w-72 rounded-lg object-cover mx-auto lg:mx-0"
                        alt="{{ $entity->name }}">
                </div>

                @php
                    $images = $entity->images() ? $entity->images()->get() : null;

                @endphp

                @if ($images !== null)

                    @php
                        $imagesClass = null;
                        $imageGap = null;

                        switch (count($images)) {
                            case 1:
                                $imageClass = 'w-[9.2rem] h-[9.2rem] lg:w-[8.6rem] lg:h-[8.6rem]';
                                $imageGap = 'gap-3';
                                break;
                            case 2:
                                $imageClass = 'w-[9.2rem] h-[9.2rem] lg:w-[8.6rem] lg:h-[8.6rem]';
                                $imageGap = 'gap-3';
                                break;
                            case 3:
                                $imageClass = 'w-[6rem] h-[6rem] lg:w-[5.5rem] lg:h-[5.5rem]';
                                $imageGap = 'gap-x-4';
                                break;
                            case 4:
                                $imageClass = 'w-[5rem] h-[5rem] lg:w-[4.1rem] lg:h-[4.1rem]';
                                $imageGap = 'gap-2';
                                break;

                            default:
                                $imageClass = 'w-[5rem] h-[5rem] lg:w-[4.1rem] lg:h-[4.1rem]';
                                $imageGap = 'gap-2';
                                break;
                        }

                    @endphp

                    <div class="flex flex-row {{ $imageGap }}">

                        @foreach ($images as $image)
                            <div class="flex">
                                <img src="{{ isset($image) ? asset('storage/' . $image->path) : url('/image/groups.png') }}"
                                    class="{{ $imageClass }} rounded-lg object-cover mx-auto lg:mx-0"
                                    alt="{{ $entity->name }}">
                            </div>

                            @if ($loop->iteration == 4)
                            @break
                        @endif
                    @endforeach

                    @if (count($images) == 1)
                        <div class="flex">
                            <img src="{{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/groups.png') }}"
                                class="{{ $imageClass }} rounded-lg object-cover mx-auto lg:mx-0"
                                alt="{{ $entity->name }}">
                        </div>
                    @endif

                </div>

            @endif

        </div>

        <div class="flex flex-col px-0 lg:px-6 mt-3 sm:mt-0 justify-start break-all">
            <h3 class="block text-left text-md font-semibold mx-4">
                {{ mb_substr($entity->name, 0, 90, 'UTF-8') }}
            </h3>

            @if ($entity->description)
                <span class="mx-4 text-sm font-semibold mt-4">Описание</span>
                <div class="max-h-16 md:max-h-36 lg:max-h-48 flex truncate mx-4 max-w-[50rem]">
                    <p
                        class="text-xs md:text-base text-base font-normal text-gray-500 break-words whitespace-normal text-justify">
                        {{ $entity->description }}
                    </p>
                </div>
            @endif

            @if ($entity->entity_type_id == 1)
                @if ($entity->fields && count($entity->fields) > 3)
                    <span class="mx-4 text-sm font-semibold mt-4">Деятельность</span>
                    @foreach ($entity->fields as $category)
                        <p class="flex text-left text-sm mx-4 text-gray-500 break-all">
                            &bull; {{ $category->name }}
                        </p>
                    @endforeach
                @elseif ($entity->offers && count($entity->offers) > 0)
                    <span class="mx-4 text-sm font-semibold mt-4">Деятельность</span>
                    @foreach ($entity->offers as $offer)
                        <p class="flex text-left text-sm mx-4 text-gray-500 break-all">
                            &bull; {{ $offer->name }}
                        </p>
                    @endforeach
                @endif
            @endif

            @if ($entity->city)
                <span class="mx-4 text-sm mt-4">Город:</span>
                <p class="flex text-left text-sm mx-4 my-1 text-gray-500 break-all">
                    {{ mb_substr($entity->city->name, 0, 400, 'UTF-8') }}
                </p>
            @endif

            @if ($entity->address)
                <span class="mx-4 text-sm mt-4">Адрес:</span>
                <p class="flex text-left text-sm mx-4 my-1 text-gray-500 break-all">
                    {{ mb_substr($entity->address, 0, 400, 'UTF-8') }}
                </p>
            @endif

            @if ($entity->phone)
                <span class="mx-4 text-sm mt-4">Телефон:</span>
                <p class="flex text-left text-sm mx-4 my-1 text-gray-500 break-all">
                    {{ mb_substr($entity->phone, 0, 400, 'UTF-8') }}
                </p>
            @endif

            <div class="my-3 pl-4">
                <x-pages.social :entity=$entity />
            </div>

            <div class="my-3 pl-0 ms:pl-4">
                @php
                    $message = null;
                    if(isset($entity->whatsapp)){
                        $message = $entity->whatsapp;
                    }elseif(isset($entity->telegram)){
                        $message = $entity->telegram;
                    }elseif(isset($entity->phone)){
                        $message = "sms:" . $entity->phone . "?body=Привет!";
                    }
                @endphp
                @if(isset($message))
                    <a href="{{ $message }}" class="cursor-pointer inline-block bg-blue-400 hover:bg-blue-500 rounded-lg px-6 pb-2 pt-2.5 mt-1 w-full ms:w-32 text-white">
                        Написать
                    </a>
                @endif
                @if(isset($entity->phone))
                    <a href="tel:{{ $entity->phone }}" class="cursor-pointer inline-block bg-green-400 hover:bg-green-500 rounded-lg px-6 pb-2 pt-2.5 mt-1 w-full ms:w-36 text-white">
                        Позвонить
                    </a>
                @endif
            </div>

            @role('super-admin')
                <div class="absolute right-4 bottom-1">
                    <a href="{{ route('admin.entity.edit', ['entity' => $entity->id]) }}"
                        class="[&>svg]:fill-[#a1b4c2]">
                        перейти в админ-панель
                    </a>
                </div>
            @endrole

            <div class="hidden lg:block absolute right-4 w-4 h-4">
                <a href="{{ url()->previous() }}" class="[&>svg]:fill-[#a1b4c2]">
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
</section>
