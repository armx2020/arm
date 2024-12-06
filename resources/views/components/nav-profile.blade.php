<div class="flex flex-col basis-full lg:basis-1/5 ">
    <div class="flex flex-row">
        <div class="bg-white p-2 rounded-md my-1 basis-full flex lg:hidden" id="button-profile-menu">
            <p class="mx-auto text-lg uppercase" id="p-profile-menu">меню</p>
        </div>
    </div>
    <div class="bg-white rounded-md pb-3 lg:m-3 my-3 hidden lg:block" id="select-profile-menu">
        <ul class="m-6 text-sm">

            @if ($page == 'main')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Моя страницы</a>
                </li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Моя страницы</a></li>
            @endif

            @if ($page == 'mycompanies')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a
                        href="{{ route('mycompanies.index') }}">Мои компании</a></li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mycompanies.index') }}">Мои
                        компании</a></li>
            @endif

            @if ($page == 'mygroups')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mygroups.index') }}">Мои
                        группы</a></li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mygroups.index') }}">Мои группы</a>
                </li>
            @endif

            @if ($page == 'myoffers')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myoffers.index') }}">Мои
                        товары и услуги</a></li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myoffers.index') }}">Мои товары и
                        услуги</a></li>
            @endif

            @if ($page == 'mynews')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a
                        href="{{ route('mynews.index') }}">Мои новости</a></li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mynews.index') }}">Мои новости</a></li>
            @endif

            @if ($page == 'myevents')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a
                        href="{{ route('myevents.index') }}">Мои события</a></li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myevents.index') }}">Мои события</a>
                </li>
            @endif

            @if ($page == 'myworks')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a
                        href="{{ route('myworks.index') }}">Работа</a></li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myworks.index') }}">Работа</a></li>
            @endif


            @if ($page == 'myprojects')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a
                        href="{{ route('myprojects.index') }}">Мои проекты</a></li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('myprojects.index') }}">Мои
                        проекты</a></li>
            @endif

            <hr class="mt-3">

            @if ($page == 'profile')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a
                        href="{{ route('profile.edit') }}">Настройки</a></li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('profile.edit') }}">Настройки</a></li>
            @endif

            @if ($page == 'questions')
                <li class="bg-gray-100 p-2 hover:text-gray-500 rounded-md"><a href="{{ route('questions') }}">Частые
                        вопросы</a></li>
            @else
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('questions') }}">Частые вопросы</a>
                </li>
            @endif

            @role('super-admin')
                <hr class="mt-3">
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('admin.dashboard') }}">Админ панель</a>
                </li>
            @endrole

        </ul>
    </div>
</div>
