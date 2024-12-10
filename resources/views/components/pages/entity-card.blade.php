<section>
    <div class="flex flex-col mx-auto my-6 lg:my-8">

        <div class="flex flex-col sm:flex-row basis-full bg-white rounded-md p-2 lg:p-4">


            <div class="flex flex-col basis-1/5 flex-none">
                <img src="{{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/groups.png') }}"
                    class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="{{ $entity->name }}">

                @if ($entity->getTable() == 'projects')
                    <x-pages.donations-for-project :$entity />
                @endif
            </div>

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

                @if ($entity->getTable() == 'companies')
                    @if ($entity->categories && count($entity->categories) > 3)
                        <span class="mx-4 text-sm font-semibold mt-4">Деятельность</span>
                        @foreach ($entity->categories as $category)
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

                <div class="my-3">
                    <x-pages.social :entity=$entity />
                </div>

            </div>
        </div>




    </div>



    @if ($entity->getTable() == 'companies')
        <x-pages.company-offers :$entity />
    @endif
</section>
