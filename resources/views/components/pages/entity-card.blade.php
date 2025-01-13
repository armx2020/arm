<section>
    <div class="flex flex-col mx-auto my-6 lg:my-8">

        <div class="flex flex-col sm:flex-row bg-white rounded-md p-3 lg:p-4 relative h-auto lg:min-h-80">

            <div class="flex sm:hidden pb-4 px-3 w-full justify-end">
                <a href="{{ url()->previous() }}" class="[&>svg]:fill-[#a1b4c2] w-3 h-3">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                    </svg>
                </a>
            </div>

            <img src="{{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/groups.png') }}"
                class="h-full w-full  lg:h-72 lg:w-72 rounded-lg object-cover" alt="{{ $entity->name }}">

            @if ($entity->getTable() == 'projects')
                <x-pages.donations-for-project :$entity />
            @endif

            <div class="flex flex-col px-0 lg:px-6 mt-3 sm:mt-0 justify-start break-all">
                <h3 class="block text-left text-md font-semibold mx-4">
                    {{ mb_substr($entity->name, 0, 90, 'UTF-8') }}
                </h3>

                @if ($entity->description)
                    <span class="mx-4 text-sm font-semibold mt-4">Описание</span>
                    <p class="flex text-left text-sm mx-4 my-1 text-gray-500 break-all">
                        {{ mb_substr($entity->description, 0, 400, 'UTF-8') }}
                    </p>
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

                @if ($entity->address)
                    <span class="mx-4 text-sm mt-4">Адрес:</span>
                    <p class="flex text-left text-sm mx-4 my-1 text-gray-500 break-all">
                        {{ mb_substr($entity->address, 0, 400, 'UTF-8') }}
                    </p>
                @endif

                <div class="my-3 pl-4">
                    <x-pages.social :entity=$entity />
                </div>

                @role('super-admin')
                    <div class="hidden lg:block absolute right-4 bottom-4">
                        <a href="{{ route('admin.entity.edit', ['entity' => $entity->id]) }}" class="[&>svg]:fill-[#a1b4c2]">
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
