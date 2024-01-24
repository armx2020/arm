<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="grid grid-rows-3 lg:grid-rows-2 w-11/12 lg:w-10/12 gap-2 max-w-7xl mx-auto my-5">
        <div class="row-span-2 lg:row-span-1 grid grid-cols-1 lg:grid-cols-2 gap-2 lg:gap-3">
            <div>
                <div class="flex items-center sm:divide-x sm:divide-gray-100 sm:mb-0">
                    <form class="w-full" method="get">
                        <label for="users-search" class="sr-only">Search</label>
                        <div class="w-full">
                            <input type="text" placeholder="поиск по названию, описанию" wire:model="search"
                                class="bg-white border-0 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <div class="bg-white rounded-lg grid-cols-1">
                    <select name="region" class="w-full border-0 rounded-lg" wire:model="region" autocomplete="off">
                        @foreach ($regions as $region)
                            <option value='{{ $region->id }}'>{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row-span-1 flex flex-nowrap gap-x-2 overflow-x-scroll scrollhidden lowercase max-w-full">
            <div class="flex flex-nowrap gap-x-2 overflow-x-scroll scrollhidden lowercase max-w-full">
                <div class="flex-none py-2 px-3 rounded-md cursor-pointer" id="select-area_0"
                    @if ($term == 0) style="background-color:rgb(59 130 246);color:white" @else style="background-color:white;color:black;" @endif>
                    <input class="hidden" type="radio" wire:model="term" value="0" name="select" />
                    <p class="inline-block " for="checkboxDefault">
                        Все группы
                    </p>
                </div>
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById("select-area_0").onclick = function() {
                            document.querySelector('input[name="select"][value="0"]').click();
                            document.getElementById("select-area_0").scrollIntoView({
                                block: 'nearest',
                                inline: "center"
                            });
                        };
                    });
                </script>
                @foreach ($categories as $category)
                    <div class="flex-none py-2 px-3 rounded-md cursor-pointer" id="select-area_{{ $category->id }}"
                        @if ($term == $category->id) style="background-color:rgb(59 130 246);color:white"
                    @else
                    style="background-color: white;color:black;" @endif>
                        <input class="hidden" type="radio" wire:model="term" value="{{ $category->id }}"
                            name="select" />
                        <p class="inline-block " for="checkboxDefault">
                            {{ $category->name }}
                        </p>
                    </div>
                    <script type='text/javascript'>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById("select-area_{{ $category->id }}").onclick = function() {
                                document.querySelector('input[name="select"][value="{{ $category->id }}"]').click();
                                document.getElementById("select-area_{{ $category->id }}").scrollIntoView({
                                    block: 'nearest',
                                    inline: "center"
                                });
                            };
                        });
                    </script>
                @endforeach
            </div>
        </div>
    </div>

    <div class="w-11/12 lg:w-10/12 max-w-7xl mx-auto pb-5">

        <div wire:loading class="">
            <div>
                <div
                    class="flex flex-nowrap lg:flex-none lg:grid lg:grid-cols-4 gap-2 lg:gap-5 overflow-x-scroll scrollhidden">
                    <div class="block lg:col-span-1">
                        <div class="flex flex-col rounded-2xl bg-white h-[26rem]">
                            <div class="flex">
                                <div class="h-36 w-full rounded-t-2xl flex object-cover bg-slate-300 animate-pulse">
                                </div>
                            </div>
                            <div class="px-4 py-3">
                                <div class="h-12 w-44 lg:w-[17rem]">
                                    <h5 class="break-words text-sm lg:text-lg font-semibold animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-full flex-auto cursor-wait bg-current align-middle text-base text-neutral-800 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                                <div class="h-16">
                                    <h5 class="break-words text-sm lg:text-md font-normal animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-full flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                                <div class="h-16">
                                    <h5 class="break-words text-sm lg:text-md font-normal animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="block lg:col-span-1">
                        <div class="flex flex-col rounded-2xl bg-white h-[26rem]">
                            <div class="flex">
                                <div class="h-36 w-full rounded-t-2xl flex object-cover bg-slate-300 animate-pulse">
                                </div>
                            </div>
                            <div class="px-4 py-3">
                                <div class="h-12 w-44 lg:w-[17rem]">
                                    <h5 class="break-words text-sm lg:text-lg font-semibold animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-full flex-auto cursor-wait bg-current align-middle text-base text-neutral-800 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                                <div class="h-16">
                                    <h5 class="break-words text-sm lg:text-md font-normal animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-full flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                                <div class="h-16">
                                    <h5 class="break-words text-sm lg:text-md font-normal animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block lg:col-span-1">
                        <div class="flex flex-col rounded-2xl bg-white h-[26rem]">
                            <div class="flex">
                                <div class="h-36 w-full rounded-t-2xl flex object-cover bg-slate-300 animate-pulse">
                                </div>
                            </div>
                            <div class="px-4 py-3">
                                <div class="h-12 w-44 lg:w-[17rem]">
                                    <h5 class="break-words text-sm lg:text-lg font-semibold animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-full flex-auto cursor-wait bg-current align-middle text-base text-neutral-800 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                                <div class="h-16">
                                    <h5 class="break-words text-sm lg:text-md font-normal animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-full flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                                <div class="h-16">
                                    <h5 class="break-words text-sm lg:text-md font-normal animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block lg:col-span-1">
                        <div class="flex flex-col rounded-2xl bg-white h-[26rem]">
                            <div class="flex">
                                <div class="h-36 w-full rounded-t-2xl flex object-cover bg-slate-300 animate-pulse">
                                </div>
                            </div>
                            <div class="px-4 py-3">
                                <div class="h-12 w-44 lg:w-[17rem]">
                                    <h5 class="break-words text-sm lg:text-lg font-semibold animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-full flex-auto cursor-wait bg-current align-middle text-base text-neutral-800 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                                <div class="h-16">
                                    <h5 class="break-words text-sm lg:text-md font-normal animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-full flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                                <div class="h-16">
                                    <h5 class="break-words text-sm lg:text-md font-normal animate-pulse">
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                        <span
                                            class="rounded-md inline-block min-h-[1em] w-2/3 flex-auto cursor-wait bg-current align-middle text-base text-neutral-500 opacity-50 dark:text-neutral-50"></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div wire:loading.remove class="">
            <div x-data>
                <div x-ref="categories"
                    class="flex flex-nowrap lg:flex-none lg:grid lg:grid-cols-4 gap-2 lg:gap-5 overflow-x-scroll scrollhidden">
                    @foreach ($groups as $group)
                        <div class="block lg:col-span-1">
                            <div class="flex flex-col rounded-2xl bg-white h-[26rem]">
                                <div class="flex">
                                    @if ($group->image == null)
                                        <img class="h-36 w-full rounded-t-2xl flex object-cover"
                                            src="{{ url('/image/no-image.png') }}" alt="image" />
                                    @else
                                        <img class="h-36 w-full rounded-t-2xl flex object-cover"
                                            src="{{ asset('storage/' . $group->image) }}" alt="image">
                                    @endif
                                </div>
                                <div class="px-4 py-3">
                                    <div class="h-12 w-44 lg:w-48">
                                        <h5 class="break-words text-xs lg:text-lg font-semibold">
                                            {{ $group->name }}
                                        </h5>
                                    </div>
                                    <div class="h-16">
                                        <h5 class="break-words text-xs lg:text-md font-normal">
                                            {{ $group->description }}
                                        </h5>
                                    </div>
                                    <a href="{{ route('group.show', ['id' => $group->id]) }}"
                                        class="text-blue-600 text-xs md:text-md text-center font-semibold">
                                        Подробнее →
                                    </a>
                                    <ul class="flex flex-wrap my-2 lowercase">
                                        <li class="text-xs lg:text-sm px-2 m-1 rounded-2xl border border-black">
                                            #{{ $group->category->name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="block lg:hidden text-right text-blue-600 w-11/12 lg:w-10/12 max-w-7xl mx-auto mt-2">
                    <button x-on:click="$refs.categories.scrollLeft -= 140" class="font-extrabold text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg"width="25" height="23" viewBox="0 0 25 23"
                            fill="none">
                            <path d="M11.5833 2L2 11.5833L11.5833 21.1667M23.0833" stroke="#1C64F2" stroke-width="3"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button x-on:click="$refs.categories.scrollLeft += 140" class="font-extrabold text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="23" viewBox="20 0 30 23" fill="none">
                            <path d="M11.5833 21.1667M23.0833 2L32.6667 11.5833L23.0833 21.1667" stroke="#1C64F2" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-center w-11/12 lg:w-10/12 max-w-7xl mx-auto pb-5 lg:pb-10">
        <a class="my-2 lg:my-4 rounded-md bg-blue-500 text-white text-center w-64 p-2 items-center font-normal"
            href="{{ route('group.index') }}">
            Загрузить больше
        </a>
    </div>
    <div class="flex justify-center w-11/12 lg:w-10/12 max-w-7xl mx-auto pb-5 lg:pb-20">
        <div class="flex basis-full">
            <div class="flex flex-col basis-full bg-white rounded-md p-4 lg:p-10">
                <div class="w-full my-1 lg:mb-4 text-md md:text-2xl lg:text-4xl font-extrabold uppercase">Часто
                    задаваемые вопросы
                </div>
                <ul class="accordion-list">
                    <li>
                        <h3>Что это за веб-сайт?</h3>
                        <div class="answer">
                            <hr class="mt-2">
                            <p>Этот веб-сайт посвящен армянским общинам в России. Мы предоставляем информацию о
                                культурных событиях, истории, активностях и новостях, связанных с армянскими общинами.
                            </p>
                        </div>
                    </li>
                    <li>
                        <h3>Какие армянские общины в России упоминаются на сайте?</h3>
                        <div class="answer">
                            <hr class="mt-2">
                            <p>На нашем сайте вы найдете информацию о различных армянских общинах, активных в России. Мы
                                стараемся охватить как можно больше общин и предоставить актуальную информацию о них.
                            </p>
                        </div>
                    </li>
                    <li>
                        <h3>Какие события и мероприятия организуются армянскими общинами в России?</h3>
                        <div class="answer">
                            <hr class="mt-2">
                            <p>Мы публикуем информацию о различных мероприятиях, таких как фестивали, концерты, выставки
                                и другие культурные события, организуемые армянскими общинами в России.</p>
                        </div>
                    </li>
                    <li>
                        <h3>Как могу участвовать или поддержать армянские общины в России?</h3>
                        <div class="answer">
                            <hr class="mt-2">
                            <p>Если вы хотите участвовать в активностях армянских общин или оказать им поддержку, наш
                                сайт предоставляет контактную информацию и информацию о способах волонтерства или
                                финансовой поддержки.</p>
                        </div>
                    </li>
                    <li>
                        <h3>Где я могу найти новости и обновления о деятельности армянских общин в России??</h3>
                        <div class="answer">
                            <hr class="mt-2">
                            <p>Мы регулярно обновляем наш сайт с последними новостями и событиями, связанными с
                                армянскими общинами в России. Вы можете найти их на нашей главной странице.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('.accordion-list > li > .answer').hide();
            $('.accordion-list > li').click(function() {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active").find(".answer").slideUp();
                } else {
                    $(".accordion-list > li.active .answer").slideUp();
                    $(".accordion-list > li.active").removeClass("active");
                    $(this).addClass("active").find(".answer").slideDown();
                }
                return false;
            });

        });
    </script>
</div>
