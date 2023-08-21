@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="myoffers"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        @if(session('success'))
        <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-5 text-base text-green-700" role="alert" style="max-height:64px;">
            {{ session('success')}}
        </div>
        @endif
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-5 relative">
                <div class="flex flex-col basis-1/4" @if( $offer->image !== null $offer->image1 !== null)
                    id="slider"
                    @endif
                    >
                    <ul>
                        @if( $offer->image == null )
                        <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <li><img src="{{ asset( 'storage/'.$offer->image) }}" class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" alt="image"></li>
                        @endif

                        @if($offer->image1)
                        <li><img src="{{ asset( 'storage/'.$offer->image1) }}" class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" alt="image1"></li>
                        @endif

                        @if($offer->image2)
                        <li><img src="{{ asset( 'storage/'.$offer->image2) }}" class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" alt="image2"></li>
                        @endif

                        @if($offer->image3)
                        <li><img src="{{ asset( 'storage/'.$offer->image3) }}" class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" alt="image3"></li>
                        @endif

                        @if($offer->image4)
                        <li><img src="{{ asset( 'storage/'.$offer->image4) }}" class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" alt="image4"></li>
                        @endif
                    </ul>

                    <div class="m-5">
                        <div class="my-2 text-center">
                            <p class="mx-3 inline">{{ $offer->price }} {{ $offer->unit_of_price }}</p>
                        </div>
                    </div>

                </div>
                <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                    <h3 class="text-left text-xl lg:text-2xl mx-4">{{ $offer->name }}</h1>
                        <p class="text-left text-md lg:text-lg mx-4 my-1 text-gray-500">город: {{ $offer->city->name }} ({{$offer->region->name }})</p>
                        <p class="text-left text-sm mx-4 my-1 text-gray-600">{{ $offer->description }}</p>

                        <hr class="mt-3 mb-3">
                        <div class="flow-root mb-3">
                            <h4 class="text-left text-lg lg:text-xl my-2 mx-3">Социальные сети</h4>
                            <div class="grid grid-cols-2 justify-center gap-2 mx-3">
                                <div class="text-sm font-normal text-gray-600">
                                    телефон: {{ $offer->phone ? $offer->phone : 'не указан' }}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    web: {{ $offer->web ? $offer->web : 'не указан' }}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    vkontakte: {{ $offer->vkontakte ? $offer->vkontakte : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    watsapp: {{ $offer->whatsapp ? $offer->whatsapp : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    telegram: {{ $offer->telegram ? $offer->telegram  : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    instagram: {{ $offer->instagram ? $offer->instagram : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    viber: {{ $offer->viber ? $offer->viber : 'не указан'}}
                                </div>

                            </div>
                        </div>
                </div>
                <div class="absolute right-6 top-3">
                    <div class="my-3 break-all text-base text-right">
                        <a href="{{ route('myoffers.edit', ['myoffer' => $offer->id]) }}" class="inline border-2 hover:border-yellow-400 border-yellow-100 bg-yellow-100 hover:bg-yellow-400 rounded-md py-2 pl-2 pr-1 my-1" title="редактировать">
                            <svg class="inline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22" height="22" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
                                <g>
                                    <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#slider ul').bxSlider({
            pager: true,
            controls: true,
            auto: true,
            mode: 'fade',
            pause: 10000,
            minSlides: 1,
            maxSlides: 1
        });
    });
</script>
@endsection