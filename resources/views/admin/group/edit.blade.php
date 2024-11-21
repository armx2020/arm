@extends('admin.layouts.app')
@section('content')
<div class="pt-6 px-4 max-w-7xl mx-auto mb-4 flex flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden">
                <div class="relative w-full h-full md:h-auto">

                    @if (session('success'))
                    <div class="my-4 bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
                        {{ session('success')}}
                    </div>
                    @endif

                    <div class="bg-white rounded-lg relative">
                        <div class="flex items-start p-5 border-b rounded-t">
                            <div class="flex items-center p-4">
                                @if( $group->image == null)
                                <img class="h-10 w-10 rounded-lg m-4" src="{{ url('/image/no-image.png')}}" alt="{{ $group->name }}">
                                @else
                                <img class="h-10 w-10 rounded-full m-4" src="{{ asset('storage/'. $group->image) }}" alt="{{ $group->image }}">
                                @endif
                                <h3 class="text-2xl font-bold leading-none text-gray-900">{{ $group->name }}</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.group.update', ['group'=> $group->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Название *</label>
                                        <input type="text" name="name" id="firstname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required value="{{ $group->name }}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="address" class="text-sm font-medium text-gray-900 block mb-2">Адрес</label>
                                        <input type="text" name="address" id="address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $group->address }}">
                                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="description" class="text-sm font-medium text-gray-900 block mb-2">Описание</label>
                                        <input type="text" name="description" id="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $group->description }}">
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="phone" class="text-sm font-medium text-gray-900 block mb-2">Телефон</label>
                                        <input type="tel" name="phone" id="phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $group->phone }}">
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="user" class="text-sm font-medium text-gray-900 block mb-2">Пользователь *</label>
                                        <select name="user" id="user" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                            <option value="">без пользователя</option>
                                            @if($category->user)
                                            <option selected value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                            @endif
                                            @foreach( $users as $user)
                                            <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="category" class="text-sm font-medium text-gray-900 block mb-2">Категория *</label>
                                        <select name="category" id="category" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @foreach( $categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-6">
                                        <label for="city" class="text-sm font-medium text-gray-900 block mb-2">Город *</label>
                                        <select name="city" class="w-full" id="dd_city">
                                            <option value='{{ $group->city->id }}'>{{ $group->city->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="my-5">
                                <div class="flex flex-row ">
                                    <label for="image" class="text-center text-sm font-medium text-gray-900 basis-1/6 my-2">image</label>
                                    <input type="file" name="image" id="image" class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                                <hr class="my-3">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="web" class="text-sm font-medium text-gray-900 block mb-2">Web</label>
                                        <input type="text" name="web" id="web" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $group->web }}">
                                        <x-input-error :messages="$errors->get('web')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="viber" class="text-sm font-medium text-gray-900 block mb-2">Viber</label>
                                        <input type="text" name="viber" id="viber" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $group->viber }}">
                                        <x-input-error :messages="$errors->get('viber')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="whatsapp" class="text-sm font-medium text-gray-900 block mb-2">Whatsapp</label>
                                        <input type="text" name="whatsapp" id="whatsapp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $group->whatsapp }}">
                                        <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="telegram" class="text-sm font-medium text-gray-900 block mb-2">Telegram</label>
                                        <input type="text" name="telegram" id="telegram" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $group->telegram }}">
                                        <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="instagram" class="text-sm font-medium text-gray-900 block mb-2">Instagram</label>
                                        <input type="text" name="instagram" id="instagram" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $group->instagram }}">
                                        <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="vkontakte" class="text-sm font-medium text-gray-900 block mb-2">Vkontakte</label>
                                        <input type="text" name="vkontakte" id="vkontakte" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" value="{{ $group->vkontakte }}">
                                        <x-input-error :messages="$errors->get('vkontakte')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="items-center py-6 border-gray-200 rounded-b">
                                    <button class="w-full text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Сохранить</button>
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