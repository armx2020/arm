<div class="flex flex-col basis-full lg:basis-1/5 ">
    <div class="flex flex-row">
        <div class="bg-white p-2 rounded-md my-1 basis-full flex lg:hidden" id="button-profile-menu">
            <p class="mx-auto text-lg uppercase" id="p-profile-menu">меню</p>
        </div>
    </div>
    <div class="bg-white rounded-md pb-3 lg:m-3 my-3 hidden lg:block" id="select-profile-menu">
        <ul class="m-6 text-sm">

            <li class="p-2 hover:text-gray-500 rounded-md @if (request()->routeIs('dashboard')) bg-gray-100 @endif"><a
                    href="{{ route('dashboard') }}">Моя
                    страница</a>
            </li>

            <li class="p-2 hover:text-gray-500 rounded-md @if (request()->routeIs('mycompanies.*')) bg-gray-100 @endif"><a
                    href="{{ route('mycompanies.index') }}">Мои компании</a>
            </li>

            <li class="p-2 hover:text-gray-500 rounded-md @if (request()->routeIs('mygroups.*')) bg-gray-100 @endif"><a
                    href="{{ route('mygroups.index') }}">Мои сообщества</a>
            </li>

            <li class="p-2 hover:text-gray-500 rounded-md @if (request()->routeIs('myoffers.*')) bg-gray-100 @endif"><a
                    href="{{ route('myoffers.index') }}">Товары и услуги</a>
            </li>

            <li class="p-2 hover:text-gray-500 rounded-md @if (request()->routeIs('myplaces.*')) bg-gray-100 @endif"><a
                    href="{{ route('myplaces.index') }}">Мои места</a>
            </li>

            <li class="p-2 hover:text-gray-500 rounded-md @if (request()->routeIs('mycommunities.*')) bg-gray-100 @endif"><a
                    href="{{ route('mycommunities.index') }}">Мои общины</a>
            </li>

            <hr class="mt-3">

            <li class="p-2 hover:text-gray-500 rounded-md @if (request()->routeIs('profile.*')) bg-gray-100 @endif"><a
                    href="{{ route('profile.edit') }}">Настройки</a>
            </li>

            <li class="p-2 hover:text-gray-500 rounded-md @if (request()->routeIs('questions')) bg-gray-100 @endif"><a
                    href="{{ route('questions') }}">Частые
                    вопросы</a>
            </li>

            @role('super-admin')
                <hr class="mt-3">
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('admin.dashboard') }}">Админ панель</a>
                </li>
            @endrole

        </ul>
    </div>
</div>
