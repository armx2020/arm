<nav class="flex-no-wrap relative flex w-full items-center justify-between bg-white lg:flex-wrap lg:justify-start p-2 lg:py-5">
    <div class="flex w-11/12 flex-wrap items-center justify-between mx-auto">
        <div class="block px-2 xl:hidden">
            <a class="" href="{{ route('home') }}">
                <img src="{{ url('/image/logo-min.png')}}" class="w-20 h-8" alt="logo" />
            </a>
        </div>
        <div class="block px-2 xl:hidden">
            <button class="text-blue-600 text-sm hover:text-blue-400" id="locationButton1">
                <img src="{{ url('/image/location-marker.png')}}" class="w-4 h-4 inline" />
                @if ($city)
                {{ preg_replace("/\([^)]+\)/","", $city) }}
                @else
                Вся Россия
                @endif
            </button>
        </div>
        <button class="block px-2 xl:hidden" type="button" id="openMenu">
            <span class="[&>svg]:w-7">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
                    <path fill-rule="evenodd" d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
        <div class="bg-white w-full min-h-screen absolute top-0 right-0 z-40 hidden" id="menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" id="closeMenu" class="w-7 h-7 absolute right-4 top-2">
                <g>
                    <path d="M21 21L12 12M12 12L3 3M12 12L21.0001 3M12 12L3 21.0001" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </g>
            </svg>
            <ul class="list-style-none mx-auto flex flex-col pl-0 text-center text-xl mt-10">
                <li class="mb-4 p-4 block border">
                    <a class="mx-4 text-md" href="{{ route('login') }}">Войти</a>
                    <a class="mx-4 text-md" href="{{ route('register') }}">Регистрация</a>
                </li>
                <li class="mb-2 block">
                    <a class="" href="{{ route('project.index') }}">Проекты</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('offer.index') }}">Маркет</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('event.index') }}">Афиша</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('news.index') }}">Новости</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('group.index') }}">Группы</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('vacancy.index') }}">Работа</a>
                </li>
            </ul>
        </div>
        <div class="hidden flex-grow items-center xl:flex">
            <a href="{{ route('home') }}">
                <img src="{{ url('/image/logo.png')}}" class="w-30 h-10" alt="logo" />
            </a>
        </div>
        <div class="visible hidden flex-grow basis-full items-center xl:!flex xl:basis-auto">
            <ul class="list-style-none mr-5 flex flex-col pl-0 lg:flex-row">
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('project.index') }}">Проекты</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('offer.index') }}">Маркет</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('event.index') }}">Афиша</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('news.index') }}">Новости</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('group.index') }}">Группы</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('vacancy.index') }}">Работа</a>
                </li>
            </ul>
        </div>
        <div class="hidden lg:basis-1/3 xl:flex basis-1/4 items-center justify-between">
            <div class="block">
                <button class="text-blue-600 text-sm hover:text-blue-400 block" id="locationButton2">
                    <img src="{{ url('/image/location-marker.png')}}" class="w-4 h-4 inline align-middle" />
                    @isset ($city)
                    {{ preg_replace("/\([^)]+\)/","", $city) }}
                    @else
                    Вся Россия
                    @endisset
                </button>
            </div>

            @auth
            <div class="flex flex-row items-center">
                <a class="mx-6 text-md" href="{{ route('dashboard') }}">{{ Auth::user()->email }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-block bg-orange-600 rounded-lg px-6 pb-2 pt-2.5 text-white" href="{{ route('register') }}">
                        Выход
                    </button>
                </form>
            </div>
            @endauth

            @guest
            <div class="flex flex-row items-center">
                <a class="mx-4" href="{{ route('login') }}">Войти</a>
                <a class="inline-block bg-orange-600 rounded-lg px-6 pb-2 pt-2.5 text-white" href="{{ route('register') }}">
                    Регистрация
                </a>
            </div>
            @endguest

        </div>
    </div>
</nav>

<!-- select city -->
<div id='selectCity' class="align-middle text-right w-full lg:w-10/12 hidden">
    <div class="w-11/12 md:w-6/12 lg:w-1/4 float-right mr-3 lg:mr-24">
    <form id="formSelect" method="GET" enctype="multipart/form-data" class="object-right" action="{{ route('changeCity') }}">
        <select name="city" class="mx-7" style="width: 100%" id="dd_city">
            <option value='1'> Вся Россия</option>
        </select>
        <button type="submit" class="hidden" id="sendButton"></button>
    </form>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        // Initialize select2
        if ($("#dd_city").length > 0) {
            $("#dd_city").select2({
                ajax: {
                    url: " {{ route('cities') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }
        $('#dd_city').change(function() {
            $(this).find(":selected").each(function() {
                $( "#formSelect" ).submit();
            });
        });
    });
</script>