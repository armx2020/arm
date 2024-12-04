<div>
    <div class="flex flex-col lg:flex-row mx-auto">

        <div class="flex-col">
            <x-pages.region-select :regions=$regions />
        </div>


        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5 min-h-screen max-w-5xl">

            <div wire:loading class="w-full">
                <x-pages.loading />
            </div>

            <div wire:loading.remove class="w-full">
                @if ($entities->isEmpty())
                    <x-pages.absence-entity entitiesName="компаний" />
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
