@extends('layouts.app')

@section('title')
    <title>Все армяне - Сообщите нам о компании</title>
@endsection


@section('scripts')
    <script src="{{ url('/select2.min.js') }}"></script>
    <script src="{{ url('/jquery.maskedinput.min.js') }}"></script>
    @vite(['resources/css/select.css'])
@endsection

@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName />
    <section>
        <div class="flex flex-col sm:justify-center items-center py-6">
        
            @if (session('success'))
                <div class="mt-5 w-full sm:max-w-xl rounded-lg bg-green-100 px-6 py-5 text-base text-green-700"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="w-full sm:max-w-xl my-6 px-6 py-6 bg-white overflow-hidden sm:rounded-lg">

                <h3 class="text-xl font-semibold">Добавить компанию</h3>
                <p class="text-sm">Укажите данные компании. После проверки, он окажеться на портале</p>
                <hr class="mt-4">

                <!-- Session Status -->

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('inform-us.company') }}" enctype="multipart/form-data">
                    @csrf

                    @if (session('error'))
                        <x-input-error :messages="session('error')" class="mt-2 mb-3" />
                    @endif


                    @if ($errors->any())
                        {!! implode('', $errors->all("<div class='text-red-500'>:message</div>")) !!}
                    @endif


                    <div class="step-one">
                        <div class="mt-4">
                            <x-input-label for="checkbox-group" :value="__('Выберите деятельность *')" />
                            <div class="flex flex-col border-2 rounded-lg p-4  mt-1" id="checkbox-group">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full">

                                    @foreach ($categories as $item)
                                        <div class="flex flex-col gap-1">
                                            <div class="flex">
                                                <label for="checkbox-group-{{ $item->id }}"
                                                    class="text-base text-black ms-3 dark:text-neutral-400">{{ $item->name }}</label>
                                            </div>
                                            @foreach ($item->categories as $child)
                                                <div class="flex">
                                                    <input type="checkbox" name="fields[]" value="{{ $child->id }}"
                                                        @if (is_array(old('fields')) && in_array($child->id, old('fields'))) checked @endif
                                                        class="checkbox-{{ $loop->parent->iteration }} shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                        id="checkbox-{{ $child->id }}">
                                                    <label for="checkbox-{{ $child->id }}"
                                                        class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $child->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step-two hidden">
                        <!-- сity -->
                        <div class="my-3">
                            <label for="city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                            <select name="city" style="border-color: rgb(209 213 219); width: 100%" id="city">
                                <option value='1'>Выберете город</option>
                            </select>
                        </div>

                        <!-- name -->
                        <div class="mt-4">
                            <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Название</label>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- address -->
                        <div class="mt-4">
                            <label for="address" class="text-sm font-medium text-gray-900 block mb-2">Адрес</label>
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                :value="old('address')" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- phone -->
                        <div class="mt-4">
                            <label for="phone" class="text-sm font-medium text-gray-900 block mb-2">Телефон</label>
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                class="mt-1 block w-full mask-phone" placeholder='+7 (***) ***-**-**' :value="old('phone')"
                                required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- web -->
                        <div class="mt-4">
                            <label for="web" class="text-sm font-medium text-gray-900 block mb-2">Веб-сайт</label>
                            <x-text-input id="web" class="block mt-1 w-full" type="text" name="web"
                                placeholder='https://***********.**' :value="old('web')" />
                            <x-input-error :messages="$errors->get('web')" class="mt-2" />
                        </div>

                        <!-- telegram -->
                        <div class="mt-4">
                            <label for="telegram" class="text-sm font-medium text-gray-900 block mb-2">Telegram</label>
                            <x-text-input id="telegram" class="block mt-1 w-full" type="text" name="telegram"
                                placeholder='https://t.me/******' :value="old('telegram')" />
                            <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
                        </div>


                        <!-- whatsapp -->
                        <div class="mt-4">
                            <label for="whatsapp" class="text-sm font-medium text-gray-900 block mb-2">Whatsapp</label>
                            <x-text-input id="whatsapp" class="block mt-1 w-full" type="text" name="whatsapp"
                                placeholder='https://wa.me/***********' :value="old('whatsapp')" />
                            <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                        </div>

                        <!-- vkontakte -->
                        <div class="mt-4">
                            <label for="vkontakte" class="text-sm font-medium text-gray-900 block mb-2">Vkontakte</label>
                            <x-text-input id="vkontakte" class="block mt-1 w-full" type="text" name="vkontakte"
                                placeholder='https://vk.com/***********' :value="old('vkontakte')" />
                            <x-input-error :messages="$errors->get('vkontakte')" class="mt-2" />
                        </div>

                        <!-- instagram -->
                        <div class="mt-4">
                            <label for="instagram" class="text-sm font-medium text-gray-900 block mb-2">Instagram</label>
                            <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram"
                                placeholder='https://instagram.com/*******' :value="old('instagram')" />
                            <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                        </div>


                        <!-- Description -->
                        <div class="mt-4">
                            <textarea id="description"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="text"
                                name="description" :value="old('description')" placeholder="Описание"></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="step-three hidden">
                        <div class="flex flex-row" id="upload_area">
                            <div class="flex relative">
                                <img class="h-16 w-16 rounded-lg m-4 object-cover" id="img"
                                    src="{{ url('/image/no-image.png') }}" alt="image">
                                <button type="button" id="remove_image" class="absolute top-2 right-0 hidden"><img
                                        src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                        style="cursor:pointer;"></button>
                            </div>

                            <div class="flex items-center">
                                <label class="input-file relative inline-block">
                                    <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image"
                                        class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                    <span
                                        class="relative inline-block  align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                        style="cursor:pointer;">Выберите файл или перетащите в эту область</span>
                                </label>
                            </div>
                        </div>
                        <hr class="mb-4">
                    </div>

                    <div class="flex items-center justify-between mt-4">

                        <div class="step-one w-full">
                            <div class="flex items-center justify-start">
                                <button id="next-to-step-two" type="button"
                                    class="px-3 inline-flex items-center py-2 border border-blue-500 rounded-md font-semibold text-xs text-blue-500 uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 px-3">
                                    {{ __('далее') }}
                                </button>
                            </div>
                        </div>


                        <div class="step-two hidden w-full">
                            <div class="flex justify-between">
                                <div class="flex items-center justify-start">
                                    <button id="back-to-step-one" type="button"
                                        class="px-3 inline-flex items-center py-2 border border-blue-500 rounded-md font-semibold text-xs text-blue-500 uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 px-3">
                                        {{ __('назад') }}
                                    </button>
                                </div>

                                <div class="flex items-center justify-start">
                                    <button id="next-to-step-three" type="button"
                                        class="px-3 inline-flex items-center py-2 border border-blue-500 rounded-md font-semibold text-xs text-blue-500 uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 px-3">
                                        {{ __('далее') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="step-three hidden w-full">
                            <div class="flex justify-between">
                                <div class="flex items-center justify-start">
                                    <button id="back-to-step-two" type="button"
                                        class="px-3 inline-flex items-center py-2 border border-blue-500 rounded-md font-semibold text-xs text-blue-500 uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 px-3">
                                        {{ __('назад') }}
                                    </button>
                                </div>

                                <div class="flex items-center justify-end">
                                    <x-primary-button class="px-3">
                                        {{ __('отправить') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

    <script type='text/javascript'>
        $(document).ready(function() {
            $('#next-to-step-two').on('click', function() {
                $('.step-two').show();
                $('.step-one').hide();
                $('.step-three').hide();
                $(this).preventDefault();
            });

            $('#back-to-step-one').on('click', function() {
                $('.step-one').show();
                $('.step-two').hide();
                $('.step-three').hide();
                $(this).preventDefault();
            });

            $('#next-to-step-three').on('click', function() {
                $('.step-three').show();
                $('.step-one').hide();
                $('.step-two').hide();
                $(this).preventDefault();
            });

            $('#back-to-step-two').on('click', function() {
                $('.step-two').show();
                $('.step-one').hide();
                $('.step-three').hide();
                $(this).preventDefault();
            });

            if ($("#city").length > 0) {
                $("#city").select2({
                    ajax: {
                        url: " {{ route('cities') }}",
                        type: "GET",
                        delay: 250,
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                query: params.term || '',
                                page: params.page || 1,
                                "_token": "{{ csrf_token() }}",
                            };

                            return query;
                        },
                        processResults: function(response, params) {
                            params.page = params.page || 1;
                            return {
                                results: response.results,
                                pagination: {
                                    more: response.pagination.more
                                }
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
                $('#img').attr('src', `{{ url('/image/no-image.png') }}`);
                $('.input-file input[type=file]').next().html('Выберите файл или перетащите в эту область');
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
                    $('#image').prop('files', files);
                }
            });
        });
    </script>
@endsection

@section('body')
    @vite(['resources/js/mask_phone.js'])
@endsection
