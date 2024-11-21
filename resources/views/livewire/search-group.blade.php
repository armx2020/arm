<div class="py-6 px-4 max-w-7xl mx-auto rounded-t-lg">
    @if (session('success'))
    <div class="mb-4 rounded-lg bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
        {{ session('success')}}
    </div>
    @endif
    @if (session('alert'))
    <div class="mb-4 rounded-lg bg-yellow-100 px-6 py-5 text-base text-yellow-700" role="alert">
        {{ session('alert')}}
    </div>
    @endif
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200">
        <div class="mb-3 w-full">
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Все группы</h1>
            </div>
            <div class="sm:flex">
                <div class="hidden sm:flex items-center sm:divide-x sm:divide-gray-100 mb-3 sm:mb-0">
                    <form class="lg:pr-3" action="#" method="GET">
                        <label for="search" class="sr-only">Search</label>
                        <div class="mt-1 relative lg:w-64 xl:w-96">
                            <input type="text" placeholder="Поиск" id="search" wire:model="term" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                        </div>
                    </form>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-3 ml-auto">
                    <a href="{{ route('admin.group.create') }}" data-modal-toggle="add-user-modal" class="w-1/2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                        <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Добавить
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div wire:loading class="w-full">
        <div class="bg-white shadow p-4">
            <div class="items-center text-center justify-center">
                <img class="h-5 w-5 rounded-full m-4 inline" src="{{ url('/image/loading.gif')}}">
                LOADING
            </div>
        </div>
    </div>
    <div wire:loading.remove>
        @if ($groups->isEmpty())
        <div class="bg-white shadow p-4">
            <div class="flex items-center text-center">
                <h3 class="text-xl font-normal mx-auto">Групп нет</h3>
            </div>
        </div>
        @else
        <div class=" mb-4 flex flex-col">
            <div class="overflow-x-auto">
                <div class="align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden">
                        <table class="table-fixed min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Имя
                                    </th>
                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Телефон
                                    </th>
                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Город
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-gray-500 uppercase">
                                        Активность
                                    </th>
                                    <th scope="col" class="p-4">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($groups as $group)
                                <tr class="hover:bg-gray-100">
                                    <td class="p-4 flex items-center whitespace-nowrap space-x-6 mr-12 lg:mr-0">
                                        @if( $group->image == null)
                                        <img class="h-10 w-10 rounded-lg m-4" src="{{ url('/image/no-image.png')}}" alt="{{ $group->name }}">
                                        @else
                                        <img class="h-10 w-10 rounded-lg object-cover m-4" src="{{ asset( 'storage/'.$group->image) }}" alt="{{ $group->image }}">
                                        @endif
                                        <a href="{{ route('admin.group.edit', [ 'group' => $group->id ]) }}">
                                            <div class="text-sm font-normal text-gray-500">
                                                <div class="text-base font-semibold text-gray-900">{{ $group->name }}</div>
                                                <div class="text-sm font-normal text-gray-500">
                                                    @if( $group->address == null)
                                                    нет адреса
                                                    @else
                                                    {{ $group->address }}
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">
                                        @if( $group->phone == null)
                                        нет телефона
                                        @else
                                        {{ $group->phone }}
                                        @endif
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">
                                        {{ $group->city->name }}
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-normal text-gray-900">
                                        <div class="flex items-center">
                                            @if($group->activity == 1)
                                            <div class="h-2.5 w-2.5 mx-auto rounded-full bg-green-400"></div>
                                            @else
                                            <div class="h-2.5 w-2.5 mx-auto rounded-full bg-red-400"></div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 whitespace-nowrap space-x-2 text-right w-1/4">
                                        <div class="flex flex-row justify-end">
                                            <form action="{{ route('admin.group.destroy', ['group' => $group->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-modal-toggle="delete-user-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                                    <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    удалить
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4">
            {{ $groups->links()}}
        </div>
        @endif
    </div>
</div>