@extends('layouts.app')
@section('content')
<nav class="w-11/12 mb-2 mt-5 rounded-md mx-auto px-3 lg:px-2 text-sm md:text-md">
    <ol class="list-reset flex">
        <li>
            <a href="{{ route('home') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Главная</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li>
            <a href="{{ route('offer.index') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Маркет</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('offer.show', ['id' => $offer->id]) }}">
                {{ $offer->name }}</a>
        </li>
    </ol>
</nav>
<section>
    <div class="flex flex-col w-11/12 mx-auto my-6 lg:my-8">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-5 relative">
            <div class="flex flex-col basis-1/4" @if( $offer->image !== null && $offer->image1 !== null)
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
                    <p class="text-left text-md lg:text-lg mx-4 my-1 text-gray-500">{{ $offer->city->name }} ({{$offer->region->name }})</p>
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
        </div>
    </div>
</section>
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