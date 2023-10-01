<div>
    <div class="flex flex-col lg:flex-row w-11/12 mx-auto">
        <div class="flex flex-col basis-full lg:basis-1/5 ">
            <div class="flex flex-row gap-3">
                <div class="bg-white rounded-md mt-3 basis-full">
                    <select name="region" class="w-full border-0" wire:model="region" autocomplete="off">
                        @foreach($regions as $region)
                        <option value='{{ $region->id }}'>{{ $region->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5 min-h-screen">

            <div class="flex flex-nowrap gap-x-2 mb-3 overflow-x-scroll scrollhidden">
                <div class="flex-none py-2 px-3 rounded-md" id="select-area" @if($term==0) style="background-color: rgb(234 88 12);" @else style="background-color: white;color:black;" @endif>
                    <input class="hidden" type="radio" wire:model="term" value="0" name="select" />
                    <p class="inline-block " for="checkboxDefault">
                        Все группы
                    </p>
                </div>
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById("select-area").onclick = function() {
                            document.querySelector('input[name="select"][value="0"]').click();
                            document.getElementById("select-area").style.backgroundColor = 'rgb(234 88 12)';
                            document.getElementById("select-area").scrollIntoView({
                                block: 'nearest',
                                inline: "center"
                            });
                        };
                    });
                </script>
                @foreach($categories as $category)
                <div class="flex-none py-2 px-3 rounded-md" id="select-area_{{ $category->id }}" @if($term==$category->id)
                    style="background-color: rgb(234 88 12);"
                    @else
                    style="background-color: white;color:black;"
                    @endif
                    >
                    <input class="hidden" type="radio" wire:model="term" value="{{ $category->id }}" name="select" />
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

            <div wire:loading class="w-full">
                <div class="p-4">
                    <div class="text-2xl items-center text-center justify-center">
                        <img class="h-5 w-5 rounded-full m-4 inline" src="{{ url('/image/loading.gif')}}">
                        ЗАГРУЗКА
                    </div>
                </div>
            </div>
            <div wire:loading.remove class="w-full">
                @if ($offers->isEmpty())
                <div class="w-full text-center">
                    <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-2 md:py-5 text-base text-green-700" role="alert" style="max-height:64px;">
                        К сожалению, в этом регионе нет предложений данной категории
                    </div>
                </div>
                @else


                @if($view == 1)
                <div class="grid grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                    @foreach($offers as $offer)
                    <div class="block rounded-lg bg-white h-60 lg:h-80">
                        <a href="{{ route('offer.show', ['id' => $offer->id ]) }}" class="block h-32 lg:h-52">
                            @if( $offer->image == null )
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                            @else
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$offer->image) }}" alt="image">
                            @endif
                        </a>
                        <div class="px-3 md:px-6">
                            <div class="h-12">
                                <h5 class="break-words text-sm lg:text-lg font-medium leading-tight text-neutral-800">
                                    {{ $offer->name }}
                                </h5>
                                <p class="text-neutral-400 hidden lg:inline">
                                    {{ $offer->company->name}}
                                </p>
                            </div>
                            <hr class="my-2">
                            <div>
                                <p class="text-right font-normal lg:font-bold pb-0">
                                    {{ $offer->price }} {{ $offer->unit_of_price }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="grid grid-cols-1 gap-3 lg:gap-5">
                    @foreach($offers as $offer)
                    <div class="flex flex-row rounded-lg bg-white h-64">
                        <a href="{{ route('offer.show', ['id' => $offer->id ]) }}" class="basis-1/3">
                            @if( $offer->image == null )
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                            @else
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$offer->image) }}" alt="image">
                            @endif
                        </a>
                        <div class="p-6 flex flex-col basis-2/3">
                            <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                {{ $offer->name }}
                            </h5>
                            <p class="inline text-neutral-400">
                                {{ $offer->company->name}}
                            </p>
                            <hr class="my-3">
                            <div>
                                <p class="text-right font-bold pb-0">
                                    {{ $offer->price }} {{ $offer->unit_of_price }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                @endif

                @if(count($recommendations) > 0)
                <div class="w-full text-left p-4 mt-8">
                    <div class="flex items-center text-left justify-left">
                        <h3 class="text-2xl font-normal">Рекомендации</h3>
                    </div>
                </div>
                <hr class="w-full mb-4">
                @if($view == 1)
                <div class="grid grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                    @foreach($recommendations as $offer)
                    <div class="block rounded-lg bg-white h-60 lg:h-80">
                        <a href="{{ route('offer.show', ['id' => $offer->id ]) }}" class="block h-32 lg:h-52">
                            @if( $offer->image == null )
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                            @else
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$offer->image) }}" alt="image">
                            @endif
                        </a>
                        <div class="px-3 md:px-6">
                            <div class="h-12">
                                <h5 class="break-words text-sm lg:text-lg font-medium leading-tight text-neutral-800">
                                    {{ $offer->name }}
                                </h5>
                                <p class="text-neutral-400 hidden lg:inline">
                                    {{ $offer->company->name}}
                                </p>
                            </div>
                            <hr class="my-2">
                            <div>
                                <p class="text-right font-normal lg:font-bold pb-0">
                                    {{ $offer->price }} {{ $offer->unit_of_price }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="grid grid-cols-1 gap-3 lg:gap-5">
                    @foreach($recommendations as $offer)
                    <div class="flex flex-row rounded-lg bg-white h-64">
                        <a href="{{ route('offer.show', ['id' => $offer->id ]) }}" class="basis-1/3">
                            @if( $offer->image == null )
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                            @else
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$offer->image) }}" alt="image">
                            @endif
                        </a>
                        <div class="p-6 flex flex-col basis-2/3">
                            <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                {{ $offer->name }}
                            </h5>
                            <p class="inline text-neutral-400">
                                {{ $offer->company->name}}
                            </p>
                            <hr class="my-3">
                            <div>
                                <p class="text-right font-bold pb-0">
                                    {{ $offer->price }} {{ $offer->unit_of_price }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
    <div class="w-full lg:w-11/12 mx-auto py-3 lg:py-6 px-6 lg:px-0">
        {{ $offers->onEachSide(2)->links()}}
    </div>
</div>