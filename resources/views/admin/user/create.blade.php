@extends('admin.layouts.app')

@section('content')

<div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto">
    <main>
        <div class=" mb-4 flex flex-col">
            <div class="overflow-x-auto">
                <div class="align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden">
                        <div class="relative w-full h-full md:h-auto">
                            <div class="bg-white rounded-lg relative">
                                <div class="flex items-start p-5 border-b rounded-t">
                                    <div class="flex items-center mb-4">
                                        <img class="h-20 w-20 rounded-full m-4" src="{{ url('/image/user.png')}}" alt="avatar">
                                        <h3 class="text-2xl font-bold leading-none text-gray-900">New user</h3>
                                    </div>
                                </div>
                                <div class="p-6 space-y-6">
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.user.store') }}">
                                        @csrf
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="firstname" class="text-sm font-medium text-gray-900 block mb-2">First Name*</label>
                                                <input type="text" name="firstname" id="firstname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('firstname')" required autofocus>
                                                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="lastname" class="text-sm font-medium text-gray-900 block mb-2">Last Name*</label>
                                                <input type="text" name="lastname" id="lastname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('lastname')" required autofocus>
                                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6">
                                                <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email*</label>
                                                <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('email')" required>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="password" class="text-sm font-medium text-gray-900 block mb-2">Password*</label>
                                                <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="password_confirmation" class="text-sm font-medium text-gray-900 block mb-2">Confirm password*</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required>
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6">
                                                <label for="city" class="text-sm font-medium text-gray-900 block mb-2">City*</label>
                                                <select name="city" class=" form-group shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" id="dd_city">
                                                    <option value='1'>-- select city --</option>
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
                                                <label for="phone" class="text-sm font-medium text-gray-900 block mb-2">Phone Number</label>
                                                <input type="tel" name="phone" id="phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('phone')">
                                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="viber" class="text-sm font-medium text-gray-900 block mb-2">Viber</label>
                                                <input type="text" name="viber" id="viber" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('viber')">
                                                <x-input-error :messages="$errors->get('viber')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="whatsapp" class="text-sm font-medium text-gray-900 block mb-2">Whatsapp</label>
                                                <input type="text" name="whatsapp" id="whatsapp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('whatsapp')">
                                                <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="telegram" class="text-sm font-medium text-gray-900 block mb-2">Telegram</label>
                                                <input type="text" name="telegram" id="telegram" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('telegram')">
                                                <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="instagram" class="text-sm font-medium text-gray-900 block mb-2">Instagram</label>
                                                <input type="text" name="instagram" id="instagram" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('instagram')">
                                                <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="vkontakte" class="text-sm font-medium text-gray-900 block mb-2">Vkontakte</label>
                                                <input type="text" name="vkontakte" id="vkontakte" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" :value="old('vkontakte')">
                                                <x-input-error :messages="$errors->get('vkontakte')" class="mt-2" />
                                            </div>

                                        </div>
                                        <div class="items-center py-6 border-gray-200 rounded-b">
                                            <button class="w-full text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Add user</button>
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
<script type='text/javascript'>
    $(document).ready(function() {
        // Initialize select2
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