@extends('admin.layouts.app')

@section('content')

<div class="pt-6 px-4">

    <div class="my-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $countUsersAll }}</span>
                    <h3 class="text-base font-normal text-gray-500">Total users</h3>
                </div>
                <div class="ml-5 w-0 flex flex-col items-end justify-end flex-1 text-green-500 text-base font-bold">
                    <h3 class="text-base font-normal text-gray-500">today</h3>
                    {{ $countUsersToday }}
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $countCompaniesAll }}</span>
                    <h3 class="text-base font-normal text-gray-500">Total companies</h3>
                </div>
                <div class="ml-5 w-0 flex flex-col items-end justify-end flex-1 text-green-500 text-base font-bold">
                    <h3 class="text-base font-normal text-gray-500">today</h3>
                    {{ $countCompaniesToday }}
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $countGroupsAll }}</span>
                    <h3 class="text-base font-normal text-gray-500">Total groups</h3>
                </div>
                <div class="ml-5 w-0 flex flex-col items-end justify-end flex-1 text-green-500 text-base font-bold">
                    <h3 class="text-base font-normal text-gray-500">today</h3>
                    {{ $countGroupsToday }}
                </div>
            </div>
        </div>

    </div>

    <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-2 gap-4">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Upcoming events</h3>
                    <!-- <span class="text-base font-normal text-gray-500">This is a list of latest transactions</span> -->
                </div>
                <div class="flex-shrink-0">
                    <!-- добавить ссылку ниже -->
                    <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">view all</a>
                </div>
            </div>
            <div class="flex flex-col mt-8">
                <div class="overflow-x-auto rounded-lg">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            name
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            time
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            parent
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">

                                    @foreach($events as $event)
                                    <tr>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                            {{ $event->name }}
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                            {{ $event->time_to_start}}
                                        </td>
                                        <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            @if($event->parent !== null)
                                                @if( $event->parent->name == null)
                                                    {{ $event->parent->firstname}} {{ $event->parent->lastname}}
                                                @else
                                                    {{ $event->parent->name }}
                                                @endif
                                            @else
                                                no parent
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold leading-none text-gray-900">Upcoming users</h3>
                <a href="{{ route('admin.user.index') }}" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                    view all
                </a>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200">

                    @foreach($users as $user)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="h-8 w-8 rounded-full" src='{{ $user->image}}' alt="avatar">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $user -> name}}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $user -> email}}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                {{ $user->city}}
                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>

    </div>


</div>

@endsection