<div>
    <div>
        <div class="flex flex-col lg:flex-row mx-auto">
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
                    <div class="flex-none py-2 px-3 rounded-md cursor-pointer" id="select-area_0" @if($type==0) style="background-color: rgb(59 130 246);color:white" @else style="background-color: white;color:black;" @endif>
                        <input class="hidden" type="radio" wire:model="type" value="0" name="select" />
                        <p class="inline-block " for="checkboxDefault">
                            Вакансии
                        </p>
                    </div>
                    <script type='text/javascript'>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById("select-area_0").onclick = function() {
                                document.querySelector('input[name="select"][value="0"]').click();
                                document.getElementById("select-area_0").style.backgroundColor = 'rgb(59 130 246)';
                                document.getElementById("select-area_0").scrollIntoView({
                                    block: 'nearest',
                                    inline: "center"
                                });
                            };
                        });
                    </script>
                    <div class="flex-none py-2 px-3 rounded-md cursor-pointer" id="select-area_1" @if($type==1) style="background-color: rgb(59 130 246);color:white" @else style="background-color: white;color:black;" @endif>
                        <input class="hidden" type="radio" wire:model="type" value="1" name="select" />
                        <p class="inline-block " for="checkboxDefault">
                            Резюме
                        </p>
                    </div>
                    <script type='text/javascript'>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById("select-area_1").onclick = function() {
                                document.querySelector('input[name="select"][value="1"]').click();
                                document.getElementById("select-area_1").style.backgroundColor = 'rgb(59 130 246)';
                                document.getElementById("select-area_1").scrollIntoView({
                                    block: 'nearest',
                                    inline: "center"
                                });
                            };
                        });
                    </script>
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
                    @if ($works->isEmpty())
                    <div class="w-full text-center">
                        <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-2 md:py-5 text-base text-green-700" role="alert" style="max-height:64px;">
                            К сожалению, в этом регионе нет {{ $typeName }}
                        </div>
                    </div>
                    @else


                    @if($view == 1)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                        @foreach($works as $work)
                        @if($typeName == 'вакансий')
                        <div class="block rounded-lg bg-white h-80">
                            <a href="{{ route('vacancy.show', ['id' => $work->id ]) }}" class="block h-52">
                                @if( $work->parent == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                @if( $work->parent->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->parent->image) }}" alt="image">
                                @endif
                                @endif
                            </a>
                            <div class="px-6">
                                <h5 class="mb-3 break-words text-sm lg:text-lg font-medium leading-tight text-neutral-800">
                                    {{$work->name }}
                                </h5>
                                <hr class="my-2">
                                <div class="my-4 break-all text-base text-right">
                                    <p class="mx-3 inline text-md font-bold">
                                        @if($work->price !== null && $work->price !== 0)
                                        {{ $work->price }} RUB.
                                        @else
                                        no price
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="block rounded-lg bg-white h-80">
                            <a href="{{ route('resume.show', ['id' => $work->id ]) }}" class="block h-52">
                                @if( $work->user->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->user->image) }}" alt="image">
                                @endif
                            </a>
                            <div class="px-3 md:px-6">
                                <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                    {{ $work->name }}
                                </h5>
                                <hr class="my-2">
                                <div class="my-4 break-all text-base text-right">
                                    <p class="mx-3 inline text-md font-bold">
                                        @if($work->price !== 0)
                                        {{ $work->price }} RUB.
                                        @else
                                        no price
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @else
                    <div class="grid grid-cols-1 gap-3 lg:gap-5">
                        @foreach($works as $work)
                        @if($typeName == 'вакансий')
                        <div class="flex flex-row rounded-lg bg-white h-64">
                            <a href="{{ route('vacancy.show', ['id' => $work->id ]) }}" class="basis-1/2">
                                @if( $work->parent == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                @if( $work->parent->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->parent->image) }}" alt="image">
                                @endif
                                @endif
                            </a>
                            <div class="p-6 flex flex-col basis-2/3">
                                <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                    {{$work->name }}
                                </h5>
                                <hr class="my-3">
                                <div class="my-4 break-all text-base text-right">
                                    <p class="mx-3 inline text-md font-bold">
                                        @if($work->price !== null && $work->price !== 0)
                                        {{ $work->price }} RUB.
                                        @else
                                        no price
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="block rounded-lg bg-white h-80">
                            <a href="{{ route('resume.show', ['id' => $work->id ]) }}" class="block h-52">
                                @if( $work->user)
                                @if( $work->user->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->user->image) }}" alt="image">
                                @endif
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @endif
                            </a>
                            <div class="px-3 md:px-6">
                                <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                    {{ $work->name }}
                                </h5>
                                <hr class="my-2">
                                <div class="my-4 break-all text-base text-right">
                                    <p class="mx-3 inline text-md font-bold">
                                        @if($work->price !== 0)
                                        {{ $work->price }} RUB.
                                        @else
                                        no price
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
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
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                        @foreach($recommendations as $work)
                        @if($typeName == 'ВАКАНСИЙ')
                        <div class="block rounded-lg bg-white h-80">
                            <a href="{{ route('vacancy.show', ['id' => $work->id ]) }}" class="block h-52">
                                @if( $work->parent == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                @if( $work->parent->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->parent->image) }}" alt="image">
                                @endif
                                @endif
                            </a>
                            <div class="px-3 md:px-6">
                                <h5 class="mb-3 break-words text-sm lg:text-lg font-medium leading-tight text-neutral-800">
                                    {{$work->name }}
                                </h5>
                                <hr class="my-2">
                                <div class="my-4 break-all text-base text-right">
                                    <p class="mx-3 inline text-md font-bold">
                                        @if($work->price !== null && $work->price !== 0)
                                        {{ $work->price }} RUB.
                                        @else
                                        no price
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="block rounded-lg bg-white h-80">
                            <a href="{{ route('resume.show', ['id' => $work->id ]) }}" class="block h-52">
                                @if( $work->user)
                                @if( $work->user->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->user->image) }}" alt="image">
                                @endif
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @endif
                            </a>
                            <div class="px-3 md:px-6">
                                <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                    {{ $work->name }}
                                </h5>
                                <hr class="my-2">
                                <div class="my-4 break-all text-base text-right">
                                    <p class="mx-3 inline text-md font-bold">
                                        @if($work->price !== 0)
                                        {{ $work->price }} RUB.
                                        @else
                                        no price
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @else
                    <div class="grid grid-cols-1 gap-3 lg:gap-5">
                        @foreach($recommendations as $work)
                        @if($typeName == 'ВАКАНСИЙ')
                        <div class="flex flex-row rounded-lg bg-white h-64">
                            <a href="{{ route('vacancy.show', ['id' => $work->id ]) }}" class="basis-1/2">
                                @if( $work->parent == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                @if( $work->parent->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->parent->image) }}" alt="image">
                                @endif
                                @endif
                            </a>
                            <div class="p-6 flex flex-col basis-2/3">
                                <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                    {{$work->name }}
                                </h5>
                                <hr class="my-3">
                                <div class="my-4 break-all text-base text-right">
                                    <p class="mx-3 inline text-md font-bold">
                                        @if($work->price !== null && $work->price !== 0)
                                        {{ $work->price }} RUB.
                                        @else
                                        no price
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="block rounded-lg bg-white h-80">
                            <a href="{{ route('resume.show', ['id' => $work->id ]) }}" class="block h-52">
                                @if( $work->user)
                                @if( $work->user->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->user->image) }}" alt="image">
                                @endif
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @endif
                            </a>
                            <div class="px-6">
                                <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                    {{ $work->name }}
                                </h5>
                                <hr class="my-2">
                                <div class="my-4 break-all text-base text-right">
                                    <p class="mx-3 inline text-md font-bold">
                                        @if($work->price !== 0)
                                        {{ $work->price }} RUB.
                                        @else
                                        no price
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="w-full lg:w-11/12 mx-auto py-3 lg:py-6 px-6 lg:px-0">
            {{ $works->onEachSide(2)->links()}}
        </div>
    </div>
</div>