<div>
    <div>
        <div class="flex flex-col lg:flex-row mx-auto">
            <div class="flex flex-col basis-full lg:basis-1/5 ">
                <div class="flex flex-row gap-3">
                    <div class="bg-white rounded-md my-3 basis-full">
                        <select name="region" class="w-full border-0" wire:model="region" autocomplete="off">
                            @foreach($regions as $region)
                            <option value='{{ $region->id }}'>{{ $region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5 min-h-screen">
                <div wire:loading class="w-full">
                    <div class="p-4">
                        <div class="text-2xl items-center text-center justify-center">
                            <img class="h-5 w-5 rounded-full m-4 inline" src="{{ url('/image/loading.gif')}}">
                            ЗАГРУЗКА
                        </div>
                    </div>
                </div>
                <div wire:loading.remove class="w-full">
                    @if ($news->isEmpty())
                    <div class="w-full text-center">
                        <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-2 md:py-5 text-base text-green-700" role="alert" style="max-height:64px;">
                            К сожалению, в этом регионе нет новостей
                        </div>
                    </div>
                    @else

                    @if($view == 1)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                        @foreach($news as $new)
                        <div class="block rounded-lg bg-white h-80">
                            <a href="{{ route('news.show', ['id' => $new->id ]) }}" class="block h-52">
                                @if( $new->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$new->image) }}" alt="image">
                                @endif
                            </a>
                            <div class="px-3 md:px-6">
                                <div class="h-12">
                                    <h5 class="mb-3 break-words text-sm lg:text-lg font-medium leading-tight text-neutral-800">
                                        {{ $new->name }}
                                    </h5>
                                </div>
                                <hr class="my-3">
                                <div>
                                    <p class="text-right pb-0">{{ $new->date }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="grid grid-cols-1 gap-3 lg:gap-5">
                        @foreach($news as $new)
                        <div class="flex flex-col sm:flex-row rounded-lg bg-white h-auto sm:h-64">
                            <a href="{{ route('news.show', ['id' => $new->id ]) }}" class="w-full sm:basis-1/3">
                                @if( $new->image == null )
                                <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$new->image) }}" alt="image">
                                @endif
                            </a>
                            <div class="p-6 flex flex-col w-full sm:basis-2/3">
                                <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                    {{ $new->name }}
                                </h5>
                                <hr class="my-3">
                                <div>
                                    <p class="text-right pb-0">{{ $new->date }}</p>
                                    <p class="mb-4 break-words font-medium leading-tight text-neutral-600 line-clamp-3">
                                        {{ $new->description }}
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
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                        @foreach($recommendations as $new)
                        <div class="block rounded-lg bg-white h-80">
                            <a href="{{ route('news.show', ['id' => $new->id ]) }}" class="block h-52">
                                @if( $new->image == null )
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$new->image) }}" alt="image">
                                @endif
                            </a>
                            <div class="px-3 md:px-6">
                                <div class="h-12">
                                    <h5 class="mb-3 break-words text-sm lg:text-lg font-medium leading-tight text-neutral-800">
                                        {{ $new->name }}
                                    </h5>
                                </div>
                                <hr class="my-3">
                                <div>
                                    <p class="text-right pb-0">{{ $new->date }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="grid grid-cols-1 gap-3 lg:gap-5">
                        @foreach($recommendations as $new)
                        <div class="flex flex-row rounded-lg bg-white h-64">
                            <a href="{{ route('news.show', ['id' => $new->id ]) }}" class="basis-1/3">
                                @if( $new->image == null )
                                <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                                @else
                                <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$new->image) }}" alt="image">
                                @endif
                            </a>
                            <div class="p-6 flex flex-col basis-2/3">
                                <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                    {{ $new->name }}
                                </h5>
                                <hr class="my-3">
                                <div>
                                    <p class="text-right pb-0">{{ $new->date }}</p>
                                    <p class="mb-4 break-words font-medium leading-tight text-neutral-600">
                                        {{ $new->description}}
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
            {{ $news->onEachSide(2)->links()}}
        </div>
    </div>
</div>
