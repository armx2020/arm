@extends('admin.layouts.app')
@section('content')
<div class=" mb-4 flex flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden">
                <div class="relative w-full h-full md:h-auto">
                    <div class="bg-white rounded-lg relative">
                        <div class="flex items-start p-5 border-b rounded-t">
                            <div class="flex items-center mb-4">
                                @if( $company->logo == null)
                                <img class="h-20 w-20 rounded-full m-4" src="{{ url('/image/no-image.png')}}" alt="{{ $company->name }} logo">
                                @else
                                <img class="h-20 w-20 rounded-full m-4" src="{{ asset('storage/'. $company->logo) }}" alt="{{ $company->name }} logo">
                                @endif
                                <h3 class="text-2xl font-bold leading-none text-gray-900">Edit {{ $company->name }}</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.company.update', ['company'=> $company->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Name*</label>
                                        <input type="text" name="name" id="firstname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required value="{{ $company->name }}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="address" class="text-sm font-medium text-gray-900 block mb-2">Address*</label>
                                        <input type="text" name="address" id="address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $company->address }}" required>
                                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="description" class="text-sm font-medium text-gray-900 block mb-2">Description</label>
                                        <input type="text" name="description" id="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $company->description }}">
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="phone" class="text-sm font-medium text-gray-900 block mb-2">Phone Number</label>
                                        <input type="tel" name="phone" id="phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $company->phone }}">
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="user" class="text-sm font-medium text-gray-900 block mb-2">User*</label>
                                        <select name="user" id="user" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                            <option selected value="">no user</option>    
                                            @if($company->user)
                                            <option value="{{ $company->user->id }}">{{ $company->user->firstname }} {{ $company->user->lastname }}</option>
                                            @endif
                                            @foreach( $users as $user)
                                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-6">
                                        <label for="city" class="text-sm font-medium text-gray-900 block mb-2">City*</label>
                                        <select name="city" class="w-full" id="dd_city">
                                            <option value='{{ $company->city->id }}'>{{ $company->city->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="my-5">
                                <div class="flex flex-row ">
                                    <label for="logo" class="text-center text-sm font-medium text-gray-900 basis-1/6 my-2">logo</label>
                                    <input type="file" name="logo" id="logo" class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5">
                                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                </div>
                                <hr class="my-3">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="web" class="text-sm font-medium text-gray-900 block mb-2">Web</label>
                                        <input type="text" name="web" id="web" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $company->web }}">
                                        <x-input-error :messages="$errors->get('web')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="viber" class="text-sm font-medium text-gray-900 block mb-2">Viber</label>
                                        <input type="text" name="viber" id="viber" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $company->viber }}">
                                        <x-input-error :messages="$errors->get('viber')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="whatsapp" class="text-sm font-medium text-gray-900 block mb-2">Whatsapp</label>
                                        <input type="text" name="whatsapp" id="whatsapp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $company->whatsapp }}">
                                        <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="telegram" class="text-sm font-medium text-gray-900 block mb-2">Telegram</label>
                                        <input type="text" name="telegram" id="telegram" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $company->telegram }}">
                                        <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="instagram" class="text-sm font-medium text-gray-900 block mb-2">Instagram</label>
                                        <input type="text" name="instagram" id="instagram" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $company->instagram }}">
                                        <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="vkontakte" class="text-sm font-medium text-gray-900 block mb-2">Vkontakte</label>
                                        <input type="text" name="vkontakte" id="vkontakte" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $company->vkontakte }}">
                                        <x-input-error :messages="$errors->get('vkontakte')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="items-center py-6 border-gray-200 rounded-b">
                                    <button class="text-white w-full bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save company</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
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
    });
</script>
@endsection