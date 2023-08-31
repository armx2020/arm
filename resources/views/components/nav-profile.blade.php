<div class="flex flex-col basis-full lg:basis-1/5 ">
    <div class="flex flex-row">
        <div class="bg-white p-2 rounded-md my-1 basis-full flex lg:hidden" id="button-profile-menu">
            <p class="mx-auto text-lg uppercase" id="p-profile-menu">меню</p>
        </div>
    </div>
    <div class="bg-white rounded-md pb-3 lg:m-3 my-3 hidden lg:block" id="select-profile-menu">
        <ul class="m-6 text-sm">

            @if($page == 'main')
            <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Главная</a></li>
            @else
            <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Главная</a></li>
            @endif

            @if($page == 'mycompanies')
            <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mycompanies.index') }}">Мои компании</a></li>
            @else
            <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mycompanies.index') }}">Мои компании</a></li>
            @endif

            @if($page == 'mygroups')
            <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mygroups.index') }}">Мои группы</a></li>
            @else
            <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mygroups.index') }}">Мои группы</a></li>
            @endif

            @if($page == 'myoffers')
            <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myoffers.index') }}">Маркет</a></li>
            @else
            <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myoffers.index') }}">Маркет</a></li>
            @endif

            @if($page == 'mynews')
            <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mynews.index') }}">Новости</a></li>
            @else
            <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mynews.index') }}">Новости</a></li>
            @endif

            @if($page == 'myevents')
            <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myevents.index') }}">Мероприятия</a></li>
            @else
            <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myevents.index') }}">Мероприятия</a></li>
            @endif

            @if($page == 'myresumes' || $page == 'myvacancies')
            <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><button id="dropdown_button">Работа</button></li>
            @else
            <li class="p-2 hover:text-gray-500 rounded-md"><button id="dropdown_button">Работа</button></li>
            @endif

            @if($page == 'myresumes' || $page == 'myvacancies')
            <ul id="dropdown_ul" class="block">
                @else
                <ul id="dropdown_ul" class="hidden">
                    @endif
                    @if($page == 'myresumes')
                    <li class="text-gray-400 p-2 pl-6 hover:text-gray-500 rounded-md"><a href="{{ route('myresumes.index') }}">мои резюме</a></li>
                    @else
                    <li class="text-gray-600 p-2 pl-6 hover:text-gray-500 rounded-md"><a href="{{ route('myresumes.index') }}">мои резюме</a></li>
                    @endif

                    @if($page == 'myvacancies')
                    <li class="text-gray-400 p-2 pl-6 hover:text-gray-500 rounded-md"><a href="{{ route('myvacancies.index') }}">мои вакансии</a></li>
                    @else
                    <li class="text-gray-600 p-2 pl-6 hover:text-gray-500 rounded-md"><a href="{{ route('myvacancies.index') }}">мои вакансии</a></li>
                    @endif
                </ul>


                @if($page == 'myprojects')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myprojects.index') }}">Мои проекты</a></li>
                @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myprojects.index') }}">Мои проекты</a></li>
                @endif

                <hr class="mt-3">

                @if($page == 'profile')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('profile.edit') }}">Настройки</a></li>
                @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('profile.edit') }}">Настройки</a></li>
                @endif

                @if($page == 'questions')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('questions') }}">Частые вопросы</a></li>
                @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('questions') }}">Частые вопросы</a></li>
                @endif

            </ul>
    </div>
</div>