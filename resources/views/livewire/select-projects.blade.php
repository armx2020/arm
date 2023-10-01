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
                <div class="flex-none py-2 px-3 rounded-md cursor-pointer" id="select-area_2" @if($term==2) style="background-color: rgb(234 88 12);" @else style="background-color: white;color:black;" @endif>
                    <input class="hidden" type="radio" wire:model="term" value="2" name="select" />
                    <p class="inline-block ">
                        Все проекты
                    </p>
                </div>
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById("select-area_2").onclick = function() {
                            document.querySelector('input[name="select"][value="2"]').click();
                            document.getElementById("select-area_2").style.backgroundColor = 'rgb(234 88 12)';
                            document.getElementById("select-area_2").scrollIntoView({
                                block: 'nearest',
                                inline: "center"
                            });
                        };
                    });
                </script>
                <div class="flex-none py-2 px-3 rounded-md cursor-pointer" id="select-area_0" @if($term==0) style="background-color: rgb(234 88 12);" @else style="background-color: white;color:black;" @endif>
                    <input class="hidden" type="radio" wire:model="term" value="0" name="select" />
                    <p class="inline-block">
                        Завершенные
                    </p>
                </div>
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById("select-area_0").onclick = function() {
                            document.querySelector('input[name="select"][value="0"]').click();
                            document.getElementById("select-area_0").style.backgroundColor = 'rgb(234 88 12)';
                            document.getElementById("select-area_0").scrollIntoView({
                                block: 'nearest',
                                inline: "center"
                            });
                        };
                    });
                </script>
                <div class="flex-none py-2 px-3 rounded-md cursor-pointer" id="select-area_1" @if($term==1) style="background-color: rgb(234 88 12);" @else style="background-color: white;color:black;" @endif>
                    <input class="hidden" type="radio" wire:model="term" value="1" name="select" />
                    <p class="inline-block">
                        Открытые
                    </p>
                </div>
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById("select-area_1").onclick = function() {
                            document.querySelector('input[name="select"][value="1"]').click();
                            document.getElementById("select-area_1").style.backgroundColor = 'rgb(234 88 12)';
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
                @if ($projects->isEmpty())
                <div class="w-full text-center">
                    <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-2 md:py-5 text-base text-green-700" role="alert" style="max-height:64px;">
                        К сожалению, в этом регионе нет проектов
                    </div>
                </div>
                @else

                @if($view == 1)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                    @foreach($projects as $project)
                    <div class="block rounded-lg bg-white h-[22rem]">
                        <a href="{{ route('project.show', ['id' => $project->id ]) }}" class="block h-52">
                            @if( $project->image == null )
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                            @else
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$project->image) }}" alt="image">
                            @endif
                        </a>
                        <div class="px-3 md:px-6">
                            <h5 class="mb-3 break-words text-sm lg:text-lg font-medium leading-tight text-neutral-800 h-14">
                                {{ $project->name }}
                            </h5>
                            <hr class="my-2">
                            <div>
                                <div class="my-2 flex flex-row">
                                    <div class="basis-1/2 text-left font-bold">{{ $project->donations_need }} руб.</div>
                                    <div class="basis-1/2 text-right">{!! round($project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0) !!} %</div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-md">
                                    <div class="bg-green-500 h-5 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100 rounded-s-md" style='width: {!! round($project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0) !!}%'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="grid grid-cols-1 gap-3 lg:gap-5">
                    @foreach($projects as $project)
                    <div class="flex flex-row rounded-lg bg-white h-64">
                        <a href="{{ route('project.show', ['id' => $project->id ]) }}" class="basis-1/3">
                            @if( $project->image == null )
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                            @else
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$project->image) }}" alt="image">
                            @endif
                        </a>
                        <div class="p-6 flex flex-col basis-2/3">
                            <h5 class="mb-1 break-words text-lg font-medium leading-tight text-neutral-800 1-20">
                                {{ $project->name }}
                            </h5>
                            <p class="break-words font-medium leading-tight text-neutral-800">
                                {{ $project->address}}
                            </p>
                            <hr class="my-3">
                            <p class="mb-4 break-words font-medium leading-tight text-neutral-500">
                                {{ $project->description}}
                            </p>

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
                    @foreach($recommendations as $project)
                    <div class="block rounded-lg bg-white h-96">
                        <a href="{{ route('project.show', ['id' => $project->id ]) }}" class="block h-52">
                            @if( $project->image == null )
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                            @else
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$project->image) }}" alt="image">
                            @endif
                        </a>
                        <div class="px-3 md:px-6">
                            <h5 class="mb-3 text-sm lg:text-lg break-words font-medium leading-tight text-neutral-800 h-20">
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
                @else
                <div class="grid grid-cols-1 gap-3 lg:gap-5">
                    @foreach($recommendations as $project)
                    <div class="flex flex-row rounded-lg bg-white h-64">
                        <a href="{{ route('project.show', ['id' => $project->id ]) }}" class="basis-1/3">
                            @if( $project->image == null )
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                            @else
                            <img class="h-full w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$project->image) }}" alt="image">
                            @endif
                        </a>
                        <div class="p-6 flex flex-col basis-2/3">
                            <h5 class="mb-1 break-words text-lg font-medium leading-tight text-neutral-800 1-20">
                                {{ $project->name }}
                            </h5>
                            <p class="break-words font-medium leading-tight text-neutral-800">
                                {{ $project->address}}
                            </p>
                            <hr class="my-3">
                            <p class="mb-4 break-words font-medium leading-tight text-neutral-500">
                                {{ $project->description}}
                            </p>

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
                @endif
            </div>
        </div>
    </div>
    <div class="w-full lg:w-11/12 mx-auto py-3 lg:py-6 px-6 lg:px-0">
        {{ $projects->onEachSide(2)->links()}}
    </div>
</div>