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
            <a href="{{ route('news.index') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Новости</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('news.show', ['id' => $news->id]) }}">
                {{ $news->name }}</a>
        </li>
    </ol>
</nav>
<section>
    <div class="flex flex-col w-11/12 mx-auto my-6 lg:my-8">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-5 relative">
            <div class="flex flex-col basis-1/5" @if( $news->image !== null && $news->image1 !== null)
                id="slider"
                @endif
                >
                <ul>
                    @if( $news->image == null )
                    <img src="{{ url('/image/no-image.png')}}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image" />
                    @else
                    <li><img src="{{ asset( 'storage/'.$news->image) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                    @endif

                    @if($news->image1)
                    <li><img src="{{ asset( 'storage/'.$news->image1) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image1"></li>
                    @endif

                    @if($news->image2)
                    <li><img src="{{ asset( 'storage/'.$news->image2) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image2"></li>
                    @endif

                    @if($news->image3)
                    <li><img src="{{ asset( 'storage/'.$news->image3) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image3"></li>
                    @endif

                    @if($news->image4)
                    <li><img src="{{ asset( 'storage/'.$news->image4) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image4"></li>
                    @endif
                </ul>

                <div class="m-5">
                    <div class="my-2 text-center">
                        <p class="mx-3 inline">{{ $news->date }}</p>
                    </div>
                </div>

            </div>
            <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                <h3 class="text-left text-xl lg:text-2xl mx-4">{{ $news->name }}</h1>
                    <p class="text-left text-md mx-4 my-1 text-gray-600">{{ $news->city->name }} ({{$news->region->name }})
                        <br>{{ $news->address }}
                    </p>
                    <p class="text-left text-sm mx-4 my-1 text-gray-500 break-all">{{ $news->description }}</p>
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