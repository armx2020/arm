<div>
    <div>
        <div class="flex flex-col lg:flex-row w-11/12 mx-auto">
            <div class="flex flex-col basis-full lg:basis-1/5 ">
                <div class="flex flex-row gap-3">
                    <div class="bg-white rounded-md my-3 basis-full">
                        <select name="region" class="w-full border-0" wire:model="region">
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
                    <div class="w-full text-center p-4">
                        <div class="flex items-center text-center justify-center">
                            <h3 class="text-2xl font-normal mx-auto">В РЕГИОНЕ НЕТ НОВОСТЕЙ</h3>
                        </div>
                    </div>
                    @else
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
                            <div class="px-6">
                                <div class="h-12">
                                    <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
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
                    @endif
                </div>
            </div>
        </div>
        <div class="w-full lg:w-11/12 mx-auto py-3 lg:py-6 px-6 lg:px-0">
            {{ $news->onEachSide(2)->links()}}
        </div>
    </div>
</div>