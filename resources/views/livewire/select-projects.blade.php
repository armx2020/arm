<div>
    <div class="flex flex-col lg:flex-row w-11/12 mx-auto">
        <div class="flex flex-col basis-full lg:basis-1/5 ">
            <div class="flex flex-row gap-3">
                <div class="bg-white rounded-md my-3 basis-11/12 lg:basis-full">
                    <select name="region" class="w-full border-0" wire:model="region">
                        @foreach($regions as $region)
                        <option value='{{ $region->id }}'>{{ $region->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="bg-white rounded-md my-3 w-1/12 flex lg:hidden">
                    <button class="mx-auto" id="CategoryButton">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" class="w-7 h-7">
                            <path d="M1,4.75H3.736a3.728,3.728,0,0,0,7.195,0H23a1,1,0,0,0,0-2H10.931a3.728,3.728,0,0,0-7.195,0H1a1,1,0,0,0,0,2ZM7.333,2a1.75,1.75,0,1,1-1.75,1.75A1.752,1.752,0,0,1,7.333,2Z" />
                            <path d="M23,11H20.264a3.727,3.727,0,0,0-7.194,0H1a1,1,0,0,0,0,2H13.07a3.727,3.727,0,0,0,7.194,0H23a1,1,0,0,0,0-2Zm-6.333,2.75A1.75,1.75,0,1,1,18.417,12,1.752,1.752,0,0,1,16.667,13.75Z" />
                            <path d="M23,19.25H10.931a3.728,3.728,0,0,0-7.195,0H1a1,1,0,0,0,0,2H3.736a3.728,3.728,0,0,0,7.195,0H23a1,1,0,0,0,0-2ZM7.333,22a1.75,1.75,0,1,1,1.75-1.75A1.753,1.753,0,0,1,7.333,22Z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="bg-white rounded-md py-3 hidden lg:block" id="selectCategory">
                <div class="m-2 block">
                    <input class="float-left ml-2 mr-4 mt-1 appearance-none rounded-sm " type="radio" wire:model="term" value="2" name="select" />
                    <label class="inline-block " for="checkboxDefault">
                        Все
                    </label>
                </div>
                <div class="m-2 block">
                    <input class="float-left ml-2 mr-4 mt-1 appearance-none rounded-sm " type="radio" wire:model="term" value="0" name="select" />
                    <label class="inline-block " for="checkboxDefault">
                        Завершенные
                    </label>
                </div>
                <div class="m-2 block">
                    <input class="float-left ml-2 mr-4 mt-1 appearance-none rounded-sm " type="radio" wire:model="term" value="1" name="select" />
                    <label class="inline-block " for="checkboxDefault">
                        Открытые
                    </label>
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
                @if ($projects->isEmpty())
                <div class="w-full text-center p-4">
                    <div class="flex items-center text-center justify-center">
                        <h3 class="text-2xl font-normal mx-auto">ПРОЕКТОВ НЕТ</h3>
                    </div>
                </div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                    @foreach($projects as $project)
                    <div class="block rounded-lg bg-white h-80">
                        <a href="{{ route('myprojects.show', ['myproject' => $project->id ]) }}" class="block h-52">
                            @if( $project->image == null )
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                            @else
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$project->image) }}" alt="image">
                            @endif
                        </a>
                        <div class="px-6">
                            <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                {{ $project->name }}
                            </h5>
                            <hr class="my-2">
                            <div>
                                <div class="my-2 flex flex-row">
                                    <div class="basis-1/2 text-left font-bold">{{ $project->donations_need }} руб.</div>
                                    <div class="basis-1/2 text-right">{!! round($project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0) !!} %</div>
                                </div>
                                <div class="w-full bg-gray-200">
                                    <div class="bg-green-500 h-5 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: {!! round($project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0) !!}%'></div>
                                </div>
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
        {{ $projects->onEachSide(2)->links()}}
    </div>
</div>