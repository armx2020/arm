<section>
    <div class="flex flex-col mx-auto my-6 lg:my-8">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-3 lg:p-4">


            <div class="flex flex-col basis-1/5 flex-none">
                <img src="{{ isset($entity->image) ? asset('storage/' . $entity->image) : url('/image/groups.png') }}"
                    class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="{{ $entity->name }}">

                @if ($entity->getTable() == 'projects')
                    <x-pages.donations-for-project :$entity />
                @endif
            </div>
            
            <div class="flex flex-col px-3 lg:px-6 sm:basis-full">
                <h3 class="text-left text-md font-semibold leading-tight mx-4">
                    {{ mb_substr($entity->name, 0, 130, 'UTF-8') }}
                    @if (mb_strlen($entity->name) > 130)
                        ...
                    @endif
                </h3>
                <p class="text-left text-sm mx-4 my-1 text-gray-500 break-all">
                    {{ mb_substr($entity->name, 0, 400, 'UTF-8') }}
                    @if (mb_strlen($entity->name) > 400)
                        ...
                    @endif
                </p>

                <hr class="mt-3 mb-3">

                <div class="flex flex-col basis-1/2">
                    <div class="overflow-x-auto">
                        <div class="inline-block">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-center text-sm text-surface dark:text-white">
                                    <tbody>
                                        @if ($entity->address)
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">Адрес:</td>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">
                                                    {{ $entity->city->name }},
                                                    {{ $entity->address }}</td>
                                            </tr>
                                        @endif

                                        @if ($entity->web)
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">Веб-сайт:</td>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">{{ $entity->web }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if ($entity->phone)
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">Телефон:</td>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">{{ $entity->phone }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if ($entity->whatsapp)
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">whatsapp:</td>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">
                                                    {{ $entity->whatsapp }}</td>
                                            </tr>
                                        @endif

                                        @if ($entity->telegram)
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">telegram:</td>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">
                                                    {{ $entity->telegram }}</td>
                                            </tr>
                                        @endif

                                        @if ($entity->viber)
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">Вайбер:</td>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">{{ $entity->viber }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if ($entity->instagram)
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">instagram:</td>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">
                                                    {{ $entity->instagram }}</td>
                                            </tr>
                                        @endif

                                        @if ($entity->vkontakte)
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">vkontakte:</td>
                                                <td class="whitespace-nowrap px-6 py-1 text-left">
                                                    {{ $entity->vkontakte }}</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="ya-share2" data-curtain data-size="s" data-shape="round" data-limit="0"
                data-more-button-type="short" data-services="vkontakte,odnoklassniki,telegram,viber,whatsapp"></div>
        </div>



        @if ($entity->getTable() == 'companies')
            <x-pages.company-offers :$entity />
        @endif

        @if ($entity->getTable() == 'companies' || $entity->getTable() == 'groups' || $entity->getTable() == 'users')
            <x-pages.entity-child :$entity />
        @endif

    </div>
</section>
