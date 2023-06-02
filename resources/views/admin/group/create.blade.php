@extends('admin.layouts.app')

@section('content')

<div id="main-content" class="h-full w-full p-3 bg-gray-50 relative overflow-y-auto">
    <main>
        <div class=" mb-4 flex flex-col">
            <div class="overflow-x-auto">
                <div class="align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden">
                        <div class="relative w-full px-4 h-full md:h-auto">
                            <div class="bg-white rounded-lg relative">
                                <div class="flex items-start p-5 border-b rounded-t m-1 md:m-3">
                                    <div class="flex items-center mb-4">
                                        <img class="h-20 w-20 rounded-full m-4" src="{{ url('/image/user.png')}}" alt="avatar">
                                        <h3 class="text-2xl font-bold leading-none text-gray-900">New group</h3>
                                    </div>
                                </div>

                                <div class="p-6 space-y-6">
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.group.store') }}">
                                        @csrf
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Name*</label>
                                                <input type="text" name="name" id="firstname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required autofocus autocomplete="name" :value="old('name')">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="address" class="text-sm font-medium text-gray-900 block mb-2">Address*</label>
                                                <input type="text" name="address" id="address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('address')" required autofocus autocomplete="address">
                                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="description" class="text-sm font-medium text-gray-900 block mb-2">Description</label>
                                                <input type="text" name="description" id="description" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('description')" required autofocus autocomplete="description">
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="phone" class="text-sm font-medium text-gray-900 block mb-2">Phone Number*</label>
                                                <input type="tel" name="phone" id="phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('phone')" required autocomplete="phone" autocomplete="phone">
                                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="user" class="text-sm font-medium text-gray-900 block mb-2">User*</label>
                                                <select name="user" id="user" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                                    @foreach( $users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="cstegory" class="text-sm font-medium text-gray-900 block mb-2">Category*</label>
                                                <select name="category" id="cstegory" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                                    @foreach( $categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
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
                                                <input type="text" name="web" id="web" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" autocomplete="web" :value="old('web')">
                                                <x-input-error :messages="$errors->get('web')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="viber" class="text-sm font-medium text-gray-900 block mb-2">Viber</label>
                                                <input type="text" name="viber" id="viber" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" autocomplete="viber" :value="old('viber')">
                                                <x-input-error :messages="$errors->get('viber')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="whatsapp" class="text-sm font-medium text-gray-900 block mb-2">Whatsapp</label>
                                                <input type="text" name="whatsapp" id="whatsapp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('whatsapp')" autocomplete="whatsapp">
                                                <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="telegram" class="text-sm font-medium text-gray-900 block mb-2">Telegram</label>
                                                <input type="text" name="telegram" id="telegram" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('telegram')" autocomplete="telegram">
                                                <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="instagram" class="text-sm font-medium text-gray-900 block mb-2">Instagram</label>
                                                <input type="text" name="instagram" id="instagram" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('instagram')" autocomplete="instagram">
                                                <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="vkontakte" class="text-sm font-medium text-gray-900 block mb-2">Vkontakte</label>
                                                <input type="text" name="vkontakte" id="vkontakte" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('vkontakte')" autocomplete="vkontakte">
                                                <x-input-error :messages="$errors->get('vkontakte')" class="mt-2" />
                                            </div>

                                        </div>
                                        <div class="items-center p-6 border-gray-200 rounded-b">
                                            <button class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Add company</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection