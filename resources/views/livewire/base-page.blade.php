<div>
    <div class="flex flex-col lg:flex-row mx-auto mt-3 md:mt-0">

        <div class="flex-col text-xs md:text-sm">

            <x-pages.region-select :regions=$regions />
            <div class="flex flex-row lg:flex-col">
                <x-pages.entity :entityTypies=$entityTypies />

                @isset($categories)
                    <x-pages.category-select :categories=$categories />
                @endisset
            </div>

        </div>


        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-5 lg:ml-5 min-h-screen max-w-5xl">

            <div wire:loading class="w-full">
                <x-pages.loading />
            </div>

            <div wire:loading.remove class="w-full">
                @if ($entities->isEmpty())
                    <x-pages.absence-entity />
                @else
                    <x-pages.grid :entities="$entities" :$entityShowRout />
                @endif



                @if (count($recommendations) > 0)
                    <x-pages.recommendation />
                    <x-pages.grid :entities="$recommendations" :$entityShowRout />
                @endif
            </div>

        </div>
    </div>

    <div class="w-full lg:w-11/12 mx-auto py-3 lg:py-6 px-6 lg:px-0">
        {{ $entities->onEachSide(2)->links() }}
    </div>

</div>
