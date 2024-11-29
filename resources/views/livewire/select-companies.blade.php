<div>
    <div class="flex flex-col lg:flex-row mx-auto">
        <div class="flex flex-col basis-full lg:basis-1/5 ">
            <div class="flex flex-row gap-3">
                <div class="bg-white rounded-md my-3 basis-11/12 lg:basis-full">
                    <select name="region" class="w-full border-0" wire:model="region">
                        @foreach ($regions as $region)
                            <option value='{{ $region->id }}'>{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="bg-white rounded-md my-3 w-1/12 flex lg:hidden">
                    <button class="mx-auto" id="CategoryButton">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" class="w-7 h-7">
                            <path
                                d="M1,4.75H3.736a3.728,3.728,0,0,0,7.195,0H23a1,1,0,0,0,0-2H10.931a3.728,3.728,0,0,0-7.195,0H1a1,1,0,0,0,0,2ZM7.333,2a1.75,1.75,0,1,1-1.75,1.75A1.752,1.752,0,0,1,7.333,2Z" />
                            <path
                                d="M23,11H20.264a3.727,3.727,0,0,0-7.194,0H1a1,1,0,0,0,0,2H13.07a3.727,3.727,0,0,0,7.194,0H23a1,1,0,0,0,0-2Zm-6.333,2.75A1.75,1.75,0,1,1,18.417,12,1.752,1.752,0,0,1,16.667,13.75Z" />
                            <path
                                d="M23,19.25H10.931a3.728,3.728,0,0,0-7.195,0H1a1,1,0,0,0,0,2H3.736a3.728,3.728,0,0,0,7.195,0H23a1,1,0,0,0,0-2ZM7.333,22a1.75,1.75,0,1,1,1.75-1.75A1.753,1.753,0,0,1,7.333,22Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="flex basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5 min-h-screen" style="max-width: 80%">
            <div wire:loading class="w-full">
                <x-pages.loading />
            </div>
            <div wire:loading.remove class="w-full">
                @if ($entities->isEmpty())
                    <x-pages.absence-entity entities="компаний" />
                @else
                    <x-pages.grid :entities="$entities" :$position :$entityShowRout />
                @endif

                @if (count($recommendations) > 0)
                    <div class="w-full text-left p-4 mt-8">
                        <div class="flex items-center text-left justify-left">
                            <h3 class="text-2xl font-normal">Рекомендации</h3>
                        </div>
                    </div>
                    <hr class="w-full mb-4">
                    <x-pages.grid :entities="$recommendations" :$position :$entityShowRout />
                @endif

            </div>
        </div>
    </div>
    <div class="w-full lg:w-11/12 mx-auto py-3 lg:py-6 px-6 lg:px-0">
        {{ $entities->onEachSide(2)->links() }}
    </div>
</div>
