<div>
    <div class="flex flex-col lg:flex-row mx-auto">

        <div class="flex-col">
            <x-pages.region-select :regions=$regions />

            <div class="flex flex-col basis-full lg:basis-1/5 max-w-56">
                <div class="flex flex-row gap-3">

                    <div class="bg-white mt-3 basis-full rounded-md p-3 hidden lg:block">
                        <h4 class="mb-2 font-semibold text-gray-900 dark:text-white">Категория</h4>
                        <div class="flex items-center mb-2">
                            <input type="radio" value="Вакансии" wire:model.live="category"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="closed_category"
                                class="mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Вакансии</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="radio" value="Резюмэ" wire:model.live="category"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="open_category"
                                class="mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Резюмэ</label>
                        </div>
                    </div>

                    <div class="bg-white mt-3 basis-full rounded-md block lg:hidden">
                        <select name="category" class="w-full border-0 rounded-md" wire:model.live="category"
                            autocomplete="off">
                            <option value='Вакансии'>Вакансии</option>
                            <option value='Резюмэ'>Резюмэ</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5 min-h-screen max-w-5xl">

            <div wire:loading class="w-full">
                <x-pages.loading />
            </div>

            <div wire:loading.remove class="w-full">
                @if ($entities->isEmpty())
                    <x-pages.absence-entity entitiesName="проектов" />
                @else
                    <x-pages.grid :entities="$entities" :$position :$entityShowRout />
                @endif

                <x-pages.recommendation />

                @if (count($recommendations) > 0)
                    <x-pages.grid :entities="$recommendations" :$position :$entityShowRout />
                @endif
            </div>

        </div>
    </div>

    <div class="w-full lg:w-11/12 mx-auto py-3 lg:py-6 px-6 lg:px-0">
        {{ $entities->onEachSide(2)->links() }}
    </div>

</div>
