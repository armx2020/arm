@extends('admin.layouts.app')
@section('content')
<div class="pt-6 px-4 max-w-7xl mx-auto mb-4 flex flex-col">
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
                        @if( $offer->image == null)
                        <img class="h-10 w-10 rounded-lg m-4" src="{{ url('/image/no-image.png')}}" alt="{{ $offer->name }}">
                        @else
                        <img class="h-10 w-10 rounded-full m-4" src="{{ asset('storage/'. $offer->image) }}" alt="{{ $offer->image }}">
                        @endif
                        <h3 class="text-2xl font-bold leading-none text-gray-900">{{ $offer->name }}</h3>
                    </div>
                    <div class="flow-root">
                        <table class="table-fixed min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Address
                                    </th>
                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Phone
                                    </th>
                                    <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                        Price
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
                                        @if($offer->address)
                                            {{ $offer->address}}
                                        @else
                                            no address
                                        @endif
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">
                                        @if($offer->phone)
                                            {{ $offer->phone }}
                                        @else
                                            no phone
                                        @endif
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">
                                        {{ $offer->price}} {{ $offer->unit_of_price}}
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">
                                        {{ $offer->city->name }}
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-base font-normal text-gray-900">
                                        <div class="flex items-center">
                                            @if($offer->activity == 1)
                                            <div class="h-2.5 w-2.5 mx-auto rounded-full bg-green-400"></div>
                                            @else
                                            <div class="h-2.5 w-2.5 mx-auto rounded-full bg-red-400"></div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 whitespace-nowrap space-x-2 text-right w-1/6">
                                        <div class="flex flex-row justify-end">
                                            <a href="{{ route('admin.offer.edit', ['offer' => $offer->id ]) }}" data-modal-toggle="user-modal" class="text-white mx-2 bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                                <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Edit offer
                                            </a>
                                            <form action="{{ route('admin.offer.destroy', ['offer' => $offer->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-modal-toggle="delete-user-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                                    <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Delete offer
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

                            @if($offer->web)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">viber</div>
                                <div class="text-sm font-normal text-gray-500">{{ $offer->web}}</div>
                            </div>
                            @endif

                            @if($offer->viber)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">viber</div>
                                <div class="text-sm font-normal text-gray-500">{{ $offer->viber}}</div>
                            </div>
                            @endif

                            @if($offer->whatsapp)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">watsapp</div>
                                <div class="text-sm font-normal text-gray-500">{{ $offer->whatsapp}}</div>
                            </div>
                            @endif

                            @if($offer->telegram)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">telegram</div>
                                <div class="text-sm font-normal text-gray-500">{{ $offer->telegram}}</div>
                            </div>
                            @endif

                            @if($offer->instagram)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">instagram</div>
                                <div class="text-sm font-normal text-gray-500">{{ $offer->instagram}}</div>
                            </div>
                            @endif

                            @if($offer->vkontakte)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base font-semibold text-gray-900">vkontakte</div>
                                <div class="text-sm font-normal text-gray-500">{{ $offer->vkontakte}}</div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="my-4 w-full grid grid-cols-1 gap-4">
    @if($offer->company)
    <div class="bg-white shadow rounded-lg p-3">
        <div class="flex flex-col items-center">
            <div class="flex-shrink-0 m-1">
                <span class="text-xl leading-none font-bold text-gray-900">Company's </span>
            </div>
            <a href="{{ route('admin.company.show', ['company' => $offer->company->id ]) }}" class=" text-lg p-1 m-1  rounded-md text-gray-500 bg-green-200">
                {{ $offer->company->name }}
            </a>
        </div>
    </div>
    @endif
    <div class="bg-white shadow rounded-lg p-3">
        <div class="flex flex-col items-center">
            <div class="flex-shrink-0 m-1">
                <span class="text-xl leading-none font-bold text-gray-900">Category's </span>
            </div>
            <a href="{{ route('admin.category.show', ['category' => $offer->category->id ]) }}" class=" text-lg p-1 m-1  rounded-md text-gray-500 bg-green-200">
                {{ $offer->category->name }}
            </a>
        </div>
    </div>
</div>
@endsection