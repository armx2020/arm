@extends('admin.layouts.app')
@section('content')
    <div class="pt-6 px-4 max-w-7xl mx-auto mb-4 flex flex-coll">
        <div class="overflow-x-auto w-full">
            <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden">
                    <div class="relative w-full h-full md:h-auto">

                        @if (session('success'))
                            <div class="my-4 bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="bg-white rounded-lg relative">
                            <div class="flex items-start p-5 border-b rounded-t">
                                <div class="flex items-center mb-4">
                                    @if ($company->image == null)
                                        <img class="h-10 w-10 rounded-lg m-4" src="{{ url('/image/no-image.png') }}"
                                            alt="{{ $company->name }} image">
                                    @else
                                        <img class="h-10 w-10 rounded-full m-4"
                                            src="{{ asset('storage/' . $company->image) }}"
                                            alt="{{ $company->name }} image">
                                    @endif
                                    <h3 class="text-2xl font-bold leading-none text-gray-900">{{ $company->name }}</h3>
                                </div>
                            </div>
                            <div class="p-6 space-y-6">
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{ route('admin.company.update', ['company' => $company->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name"
                                                class="text-sm font-medium text-gray-900 block mb-2">Название *</label>
                                            <input type="text" name="name" id="name"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                required value="{{ $company->name }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="address"
                                                class="text-sm font-medium text-gray-900 block mb-2">Адрес</label>
                                            <input type="text" name="address" id="address"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $company->address }}">
                                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="description"
                                                class="text-sm font-medium text-gray-900 block mb-2">Описание</label>
                                            <input type="text" name="description" id="description"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $company->description }}">
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="phone"
                                                class="text-sm font-medium text-gray-900 block mb-2">Телефон</label>
                                            <input type="tel" name="phone" id="phone"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $company->phone }}">
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6">
                                            <label for="dd_action"
                                                class="text-sm font-medium text-gray-900 block mb-2">Деятельность *</label>
                                            <select name="actions[]" class="w-full" id="dd_action" multiple="multiple">
                                                @foreach ($company->actions as $action)
                                                    <option selected value="{{ $action->id }}">
                                                        {{ $action->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-span-6">
                                            <label for="user"
                                                class="text-sm font-medium text-gray-900 block mb-2">Пользователь *</label>
                                            <select name="user" id="user"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                                <option selected value="">без пользователя</option>
                                                @if ($company->user)
                                                    <option selected value="{{ $company->user->id }}">
                                                        {{ $company->user->firstname }} {{ $company->user->lastname }}
                                                    </option>
                                                @endif
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->firstname }}
                                                        {{ $user->lastname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-span-6">
                                            <label for="dd_city" class="text-sm font-medium text-gray-900 block mb-2">Город
                                                *</label>
                                            <select name="city" class="w-full" id="dd_city">
                                                <option value='{{ $company->city->id }}'>{{ $company->city->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="my-5">
                                    <div class="flex flex-row">
                                        <label for="image"
                                            class="text-center text-sm font-medium text-gray-900 basis-1/6 my-2">Image</label>
                                        <div id="dropzone"
                                            class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5 border-2 border-dashed border-gray-300 flex justify-center items-center cursor-pointer">
                                            <p class="text-gray-500 text-sm text-center">Перетащите изображение сюда или
                                                нажмите, чтобы выбрать файл</p>
                                            <input type="file" name="image" id="image" class="hidden"
                                                accept="image/*">
                                        </div>
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>
                                    <hr class="my-3">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="web"
                                                class="text-sm font-medium text-gray-900 block mb-2">Web</label>
                                            <input type="text" name="web" id="web"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $company->web }}">
                                            <x-input-error :messages="$errors->get('web')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="viber"
                                                class="text-sm font-medium text-gray-900 block mb-2">Viber</label>
                                            <input type="text" name="viber" id="viber"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $company->viber }}">
                                            <x-input-error :messages="$errors->get('viber')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="whatsapp"
                                                class="text-sm font-medium text-gray-900 block mb-2">Whatsapp</label>
                                            <input type="text" name="whatsapp" id="whatsapp"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $company->whatsapp }}">
                                            <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="telegram"
                                                class="text-sm font-medium text-gray-900 block mb-2">Telegram</label>
                                            <input type="text" name="telegram" id="telegram"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $company->telegram }}">
                                            <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="instagram"
                                                class="text-sm font-medium text-gray-900 block mb-2">Instagram</label>
                                            <input type="text" name="instagram" id="instagram"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $company->instagram }}">
                                            <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="vkontakte"
                                                class="text-sm font-medium text-gray-900 block mb-2">Vkontakte</label>
                                            <input type="text" name="vkontakte" id="vkontakte"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ $company->vkontakte }}">
                                            <x-input-error :messages="$errors->get('vkontakte')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="items-center py-6 border-gray-200 rounded-b">
                                        <button
                                            class="text-white w-full bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                            type="submit">Сохранить</button>
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
            if ($("#dd_action").length > 0) {
                $("#dd_action").select2({
                    ajax: {
                        url: " {{ route('actions') }}",
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
    <script type="text/javascript">
        $(document).ready(function() {
            let dropzone = $("#dropzone");
            let fileInput = $("#image");

            const dragOverClasses = "border-cyan-600 bg-cyan-50";

            dropzone.on("click", function(e) {
                fileInput[0].click();
            });

            dropzone.on("dragover", function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.addClass(dragOverClasses);
            });

            dropzone.on("dragleave drop", function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.removeClass(dragOverClasses);
            });

            dropzone.on("drop", function(e) {
                let files = e.originalEvent.dataTransfer.files;
                if (files.length > 0) {
                    fileInput[0].files = files;
                    fileInput.trigger("change");
                }
            });

            fileInput.on("change", function() {
                if (fileInput[0].files.length > 0) {
                    let fileName = fileInput[0].files[0].name;
                    dropzone.find("p").text(fileName);
                }
            });
        });
    </script>
@endsection
