@extends('admin.layouts.app')
@section('content')
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden">
                <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                    @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
                        {{ session('success')}}
                    </div>
                    @endif
                    <div class="flex items-center mb-4">
                        @if( $user->image == null)
                        <img class="h-10 w-10 rounded-full m-4" src="{{ url('/image/user.png')}}" alt="{{ $user->firstname }} avatar">
                        @else
                        <img class="h-10 w-10 rounded-full m-4" src="{{ asset('storage/'. $user->image) }}" alt="{{ $user->firstname }} avatar">
                        @endif
                        <h3 class="text-2xl font-bold leading-none text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</h3>
                    </div>
                    <div class="flow-root">
                        <table class="table-fixed min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Email
                                    </th>
                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Phone
                                    </th>
                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        City
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-gray-500 uppercase">
                                        Activity
                                    </th>
                                    <th scope="col" class="p-4">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="">
                                    <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">
                                        {{ $user->email}}
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">
                                        @if( $user->phone == null)
                                        no phone
                                        @else
                                        {{ $user->phone }}
                                        @endif
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">
                                        {{ $user->city->name }}
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-normal text-gray-900">
                                        <div class="flex items-center">
                                            @if($user->activity == 1)
                                            <div class="h-2.5 w-2.5 mx-auto rounded-full bg-green-400"></div>
                                            @else
                                            <div class="h-2.5 w-2.5 mx-auto rounded-full bg-red-400"></div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 whitespace-nowrap space-x-2 text-right w-1/6">
                                        <div class="flex flex-row justify-end">
                                            <a href="{{ route('admin.user.edit', ['user' => $user->id ]) }}" data-modal-toggle="user-modal" class="text-white mx-2 bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                                <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Edit user
                                            </a>
                                            <form action="{{ route('admin.user.destroy', ['user' => $user->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-modal-toggle="delete-user-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                                    <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Delete user
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="my-3">
                    <div class="flow-root my-6">
                        <div class="grid grid-cols-3 md:grid-cols-3 justify-center gap-6">
                            @if($user->viber)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">viber</div>
                                <div class="text-sm font-normal text-gray-500">{{ $user->viber}}</div>
                            </div>
                            @endif
                            @if($user->whatsapp)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">watsapp</div>
                                <div class="text-sm font-normal text-gray-500">{{ $user->whatsapp}}</div>
                            </div>
                            @endif
                            @if($user->telegram)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">telegram</div>
                                <div class="text-sm font-normal text-gray-500">{{ $user->telegram}}</div>
                            </div>
                            @endif
                            @if($user->instagram)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">instagram</div>
                                <div class="text-sm font-normal text-gray-500">{{ $user->instagram}}</div>
                            </div>
                            @endif
                            @if($user->vkontakte)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">vkontakte</div>
                                <div class="text-sm font-normal text-gray-500">{{ $user->vkontakte}}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="my-4 px-4 w-full grid grid-cols-1 md:grid-cols-2 gap-4">
    @if (count($user->companies) > 0)
    <div class="bg-white shadow rounded-lg p-3">
        <div class="flex flex-col items-center">
            <div class="flex-shrink-0 m-1">
                <span class="text-xl leading-none font-bold text-gray-900">Companies</span>
            </div>
            <ul class="flex flex-wrap">
                @foreach ($user->companies as $company)
                <li class=" text-lg p-1 m-1  rounded-md text-gray-500 bg-green-200">
                    <a href="{{ route('admin.company.show', ['company' => $company->id]) }}">
                        {{ $company->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if (count($user->vacancies) > 0)
    <div class="bg-white shadow rounded-lg p-3">
        <div class="flex flex-col items-center">
            <div class="flex-shrink-0 m-1">
                <span class="text-xl leading-none font-bold text-gray-900">Vacancies</span>
            </div>
            <ul class="flex flex-wrap">
                @foreach ($user->vacancies as $vacancy)
                <li class=" text-lg p-1 m-1  rounded-md text-gray-500 bg-green-200">
                    <a href="{{ route('admin.vacancy.show', ['vacancy' => $vacancy->id]) }}">
                        {{ $vacancy->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if (count($user->groups) > 0)
    <div class="bg-white shadow rounded-lg p-3">
        <div class="flex flex-col items-center">
            <div class="flex-shrink-0 m-1">
                <span class="text-xl leading-none font-bold text-gray-900">Groups</span>
            </div>
            <ul class="flex flex-wrap">
                @foreach ($user->groups as $group)
                <li class=" text-lg p-1 m-1  rounded-md text-gray-500 bg-green-200">
                    <a href="{{ route('admin.group.show' , ['group' => $group->id]) }}">
                        {{ $group->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if (count($user->resumes) > 0)
    <div class="bg-white shadow rounded-lg p-3">
        <div class="flex flex-col items-center">
            <div class="flex-shrink-0 m-1">
                <span class="text-xl leading-none font-bold text-gray-900">Resumes</span>
            </div>
            <ul class="flex flex-wrap">
                @foreach ($user->resumes as $resume)
                <li class=" text-lg p-1 m-1  rounded-md text-gray-500 bg-green-200">
                    <a href="{{ route('admin.resume.show', ['resume' => $resume->id]) }}">
                        {{ $resume->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if (count($user->projects) > 0)
    <div class="bg-white shadow rounded-lg p-3">
        <div class="flex flex-col items-center">
            <div class="flex-shrink-0 m-1">
                <span class="text-xl leading-none font-bold text-gray-900">Projects</span>
            </div>
            <ul class="flex flex-wrap">
                @foreach ($user->projects as $project)
                <li class=" text-lg p-1 m-1  rounded-md text-gray-500 bg-green-200">
                    <a href="{{ route('admin.project.show', ['project' => $project->id]) }}">
                        {{ $project->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if (count($user->events) > 0)
    <div class="bg-white shadow rounded-lg p-3">
        <div class="flex flex-col items-center">
            <div class="flex-shrink-0 m-1">
                <span class="text-xl leading-none font-bold text-gray-900">Events</span>
            </div>
            <ul class="flex flex-wrap">
                @foreach ($user->events as $event)
                <li class=" text-lg p-1 m-1  rounded-md text-gray-500 bg-green-200">
                    <a href="{{ route('admin.event.show', ['event' => $event->id]) }}">
                        {{ $event->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection