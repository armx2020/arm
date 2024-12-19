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

                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.company.update', ['company' => $company->id]) }}">
                                @csrf
                                @method('PUT')
                                <input name="image_remove" type="text" id="image_remove" class="hidden"
                                    style="z-index:-10;" />

                                <div class="flex items-start p-5 border-b rounded-t">
                                    <div class="flex items-center m-2">
                                        <h3 class="text-2xl font-bold leading-none text-gray-900">{{ $company->name }}</h3>
                                    </div>
                                </div>

                                <div class="flex flex-row" id="upload_area">
                                    <div class="flex relative">
                                        @if ($company->image == null)
                                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img"
                                                src="{{ url('/image/no-image.png') }}" alt="image">
                                        @else
                                            <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img"
                                                src="{{ asset('storage/' . $company->image) }}" alt="image">
                                        @endif
                                        <button type="button" id="remove_image" class="absolute top-5 right-5"
                                            @if ($company->image == null) style="display: none;"
                                        @else
                                        style="display: block;" @endif><img
                                                src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                                style="cursor:pointer;">
                                        </button>
                                    </div>

                                    <div class="flex items-center">
                                        <label class="input-file relative inline-block">
                                            <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image"
                                                class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                            <span
                                                class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                                style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <x-input-error :messages="$errors->get('image')" />
                                </div>

                                <div class="p-6 space-y-6">

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
                                            <label for="dd_category"
                                                class="text-sm font-medium text-gray-900 block mb-2">Деятельность *</label>
                                            <div class="flex border-2 rounded-lg p-4 mt-1">
                                                <div class="grid grid-cols-3 gap-4 w-full">

                                                    @foreach ($categories as $item)
                                                        <div class="flex flex-col gap-1">
                                                            <div class="flex">
                                                                <label for="checkbox-group-{{ $loop->iteration }}"
                                                                    class="text-base text-black ms-3 dark:text-neutral-400">{{ $item->name }}</label>
                                                            </div>
                                                            @foreach ($item->categories as $child)
                                                                <div class="flex pl-4">
                                                                    <input type="checkbox" name="categories[]"
                                                                        value="{{ $child->id }}"
                                                                        @checked($company->categories->contains($child->id))
                                                                        class="checkbox-{{ $loop->parent->iteration }} shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                                        id="checkbox-{{ $loop->iteration }}">
                                                                    <label for="checkbox-{{ $loop->iteration }}"
                                                                        class="text-sm text-gray-400 ms-3 dark:text-neutral-400">{{ $child->name }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                            <x-input-error class="mt-2" :messages="$errors->get('categories')" />
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
                                            <label for="dd_city"
                                                class="text-sm font-medium text-gray-900 block mb-2">Город
                                                *</label>
                                            <select name="city" class="w-full" id="dd_city">
                                                <option value='{{ $company->city->id }}'>{{ $company->city->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
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

                                </div>
                            </form>
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
            if ($("#dd_category").length > 0) {
                $("#dd_category").select2({
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

            function previewImage(file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img').attr('src', event.target.result);
                };
                reader.readAsDataURL(file);
            }

            function handleFile(file) {
                var fileSize = file.size;
                var maxSize = 2000000; // 2 MB

                if (fileSize > maxSize) {
                    $('.input-file input[type=file]').next().html('максимальный размер 2 мб');
                    $('.input-file input[type=file]').next().css({
                        "color": "rgb(239 68 68)"
                    });
                    $('#img').attr('src', `{{ url('/image/no-image.png') }}`);
                    $('#remove_image').css({
                        "display": "none"
                    });
                } else {
                    $('.input-file input[type=file]').next().html(file.name);
                    $('.input-file input[type=file]').next().css({
                        "color": "rgb(71 85 105)"
                    });
                    $('#remove_image').css({
                        "display": "block"
                    });
                    previewImage(file);
                }
            }

            $('#image').on('change', function(event) {
                var selectedFile = event.target.files[0];
                handleFile(selectedFile);
            });

            $('#remove_image').on('click', function() {
                $('#image').val('');
                $('#image_remove').val('delete');
                $('#img').attr('src', `{{ url('/image/no-image.png') }}`);
                $('.input-file input[type=file]').next().html('Выберите файл или перетащите сюда');
                $('#remove_image').css({
                    "display": "none"
                });
            });

            var uploadArea = $('#upload_area');

            uploadArea.on('dragover', function(event) {
                event.preventDefault();
                event.stopPropagation();
                uploadArea.addClass('bg-gray-200');
            });

            uploadArea.on('dragleave', function(event) {
                event.preventDefault();
                event.stopPropagation();
                uploadArea.removeClass('bg-gray-200');
            });

            uploadArea.on('drop', function(event) {
                event.preventDefault();
                event.stopPropagation();
                uploadArea.removeClass('bg-gray-200');

                var files = event.originalEvent.dataTransfer.files;
                if (files.length > 0) {
                    var file = files[0];
                    handleFile(file);

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    $('#image').prop('files', dataTransfer.files);
                }
            });
        });
    </script>
@endsection
