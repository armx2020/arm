@extends('layouts.app')
@section('content')
    <div class="flex flex-col lg:flex-row mx-auto my-10">

        @include('profile.menu')

        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
            <div class="flex flex-col basis-full">
                <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-2 lg:p-10 relative">
                    <form method="post" action="{{ route('mygroups.store') }}" class="w-full" enctype="multipart/form-data">
                        @csrf

                        <div class="w-full">
                            <h2 class="text-xl">Добавить сообщество</h2>
                            <hr class="w-full h-2 mt-2">
                        </div>

                        <div class="flex flex-row border-b" wire:ignore>

                            <!-- image  -->
                            <div class="flex flex-row" id="upload_area" wire:ignore>
                                <div class="flex relative p-3">
                                    <img class="h-20 w-20 rounded-lg mx-4 my-2 object-cover" id="img"
                                        src="{{ url('/image/no-image.png') }}" alt="avatar">
                                    <button type="button" id="remove_image" class="absolute top-2 right-2"
                                        style="display: none;"><img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>

                                <div class="flex items-center">
                                    <label class="input-file relative inline-block">
                                        <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span"
                                            class="relative inline-block align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                            style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                    </label>
                                </div>
                            </div>

                            <!-- image 1 -->
                            <div class="hidden  flex flex-row" id="upload_area_1" wire:ignore>
                                <div class="flex relative p-3">
                                    <img class="h-20 w-20 rounded-lg mx-4 my-2 object-cover" id="img_1"
                                        src="{{ url('/image/no-image.png') }}" alt="avatar">
                                    <button type="button" id="remove_image_1" class="absolute top-2 right-2"
                                        style="display: none;"><img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>

                                <div class="flex items-center">
                                    <label class="input-file relative inline-block">
                                        <input name="image_1" type="file" accept=".jpg,.jpeg,.png" id="image_1"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span_1"
                                            class="relative inline-block align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                            style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                    </label>
                                </div>
                            </div>

                            <!-- image 2 -->
                            <div class="hidden flex flex-row" id="upload_area_2" wire:ignore>
                                <div class="flex relative p-3">
                                    <img class="h-20 w-20 rounded-lg mx-4 my-2 object-cover" id="img_2"
                                        src="{{ url('/image/no-image.png') }}" alt="avatar">
                                    <button type="button" id="remove_image_2" class="absolute top-2 right-2"
                                        style="display: none;"><img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>

                                <div class="flex items-center">
                                    <label class="input-file relative inline-block">
                                        <input name="image_2" type="file" accept=".jpg,.jpeg,.png" id="image_2"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span_2"
                                            class="relative inline-block align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                            style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                    </label>
                                </div>
                            </div>

                            <!-- image 3 -->
                            <div class="hidden flex flex-row" id="upload_area_3" wire:ignore>
                                <div class="flex relative p-3">
                                    <img class="h-20 w-20 rounded-lg mx-4 my-2 object-cover" id="img_3"
                                        src="{{ url('/image/no-image.png') }}" alt="avatar">
                                    <button type="button" id="remove_image_3" class="absolute top-2 right-2"
                                        style="display: none;"><img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>

                                <div class="flex items-center">
                                    <label class="input-file relative inline-block">
                                        <input name="image_3" type="file" accept=".jpg,.jpeg,.png" id="image_3"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span_3"
                                            class="relative inline-block align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                            style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                    </label>
                                </div>
                            </div>

                            <!-- image 4 -->
                            <div class="hidden flex flex-row" id="upload_area_4" wire:ignore>
                                <div class="flex relative p-3">
                                    <img class="h-20 w-20 rounded-lg mx-4 my-2 object-cover" id="img_4"
                                        src="{{ url('/image/no-image.png') }}" alt="avatar">
                                    <button type="button" id="remove_image_4" class="absolute top-2 right-2"
                                        style="display: none;"><img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>

                                <div class="flex items-center">
                                    <label class="input-file relative inline-block">
                                        <input name="image_4" type="file" accept=".jpg,.jpeg,.png" id="image_4"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span_4"
                                            class="relative inline-block align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                            style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div>
                            <x-input-error :messages="$errors->get('image')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="name" :value="__('Название*')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :error="$errors->get('name')" :value="old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="address" :value="__('Адрес')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :error="$errors->get('address')" :value="old('address')" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="description" :value="__('Описание')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                :error="$errors->get('description')" :value="old('description')" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="checkbox-group" :value="__('Выберите деятельность *')" />
                            <div class="flex border-2 rounded-lg p-4 mt-1 @if (count($errors->get('fields')) > 0) border-1 border-red-300 @endif"
                                id="checkbox-group">
                                <div class="grid grid-cols-3 gap-4 w-full">

                                    @foreach ($categories as $item)
                                        <div class="flex flex-col gap-1">
                                            <div class="flex">
                                                @if (count($item->categories) < 1)
                                                    <input type="radio" name="category" value="{{ $item->id }}"
                                                        @if (is_array(old('category')) && in_array($item->id, old('category'))) checked @endif
                                                        class="checkbox-{{ $loop->iteration }} shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                        id="checkbox-{{ $item->id }}">
                                                    <label for="checkbox-{{ $item->id }}"
                                                        class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $item->name }}</label>
                                                @else
                                                    <label for="checkbox-group-{{ $loop->iteration }}"
                                                        class="text-base text-black ms-3 dark:text-neutral-400">{{ $item->name }}</label>
                                                @endif
                                            </div>
                                            @foreach ($item->categories as $child)
                                                <div class="flex">
                                                    <input type="radio" name="category" value="{{ $child->id }}"
                                                        @if (is_array(old('category')) && in_array($child->id, old('category'))) checked @endif
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
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="phone" :value="__('Телефон')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                                :error="$errors->get('phone')" :value="old('phone')" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="whatsapp" :value="__('Whatsapp')" />
                            <x-text-input id="whatsapp" name="whatsapp" type="text" class="mt-1 block w-full"
                                :error="$errors->get('whatsapp')" :value="old('whatsapp')" />
                            <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="web" :value="__('Веб')" />
                            <x-text-input id="web" name="web" type="text" class="mt-1 block w-full"
                                :error="$errors->get('web')" :value="old('web')" />
                            <x-input-error class="mt-2" :messages="$errors->get('web')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="telegram" :value="__('Телеграм')" />
                            <x-text-input id="telegram" name="telegram" type="text" class="mt-1 block w-full"
                                :error="$errors->get('telegram')" :value="old('telegram')" />
                            <x-input-error class="mt-2" :messages="$errors->get('telegram')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="vkontakte" :value="__('Вконтакте')" />
                            <x-text-input id="vkontakte" name="vkontakte" type="text" class="mt-1 block w-full"
                                :error="$errors->get('vkontakte')" :value="old('vkontakte')" />
                            <x-input-error class="mt-2" :messages="$errors->get('vkontakte')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="instagram" :value="__('Инстаграм')" />
                            <x-text-input id="instagram" name="instagram" type="text" class="mt-1 block w-full"
                                :error="$errors->get('instagram')" :value="old('instagram')" />
                            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                        </div>

                        <div class="my-3">
                            <label for="city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                            <select name="city" style="border-color: rgb(209 213 219); width: 100%" id="city">
                                <option value='1'>Выберете город</option>
                            </select>
                        </div>

                        <div class="my-5">
                            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

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

            const maxSize = 2000000; // Максимальный размер файла 2 MB

            const sections = [{
                    input: '#image',
                    img: '#img',
                    span: '#image_span',
                    remove: '#remove_image',
                    section: '#upload_area'
                },
                {
                    input: '#image_1',
                    img: '#img_1',
                    span: '#image_span_1',
                    remove: '#remove_image_1',
                    section: '#upload_area_1'
                },
                {
                    input: '#image_2',
                    img: '#img_2',
                    span: '#image_span_2',
                    remove: '#remove_image_2',
                    section: '#upload_area_2'
                },
                {
                    input: '#image_3',
                    img: '#img_3',
                    span: '#image_span_3',
                    remove: '#remove_image_3',
                    section: '#upload_area_3'
                },
                {
                    input: '#image_4',
                    img: '#img_4',
                    span: '#image_span_4',
                    remove: '#remove_image_4',
                    section: '#upload_area_4'
                },
            ];

            function handleFileInput(file, index) {
                if (!file) return;

                const fileSize = file.size;
                const section = sections[index];
                const nextSection = sections[index + 1];

                if (fileSize > maxSize) {
                    $(section.span).html('Максимальный размер 2 МБ').css({
                        color: "rgb(239 68 68)"
                    });
                    return;
                }

                $(section.span).html(file.name).css({
                    color: "rgb(71 85 105)"
                });
                $(section.section).find('.flex.items-center').hide();

                // Скрыть кнопку "Удалить" на предыдущих секциях
                sections.forEach((s, i) => {
                    if (i !== index) $(s.remove).hide();
                });

                // Показать кнопку "Удалить" только для текущей секции
                $(section.remove).show();

                // Показать следующую секцию
                if (nextSection) {
                    $(nextSection.section).css({
                        display: "flex",
                        "flex-direction": "row"
                    });
                }

                // Предварительный просмотр изображения
                const reader = new FileReader();
                reader.onload = function(event) {
                    $(section.img).attr('src', event.target.result);
                };
                reader.readAsDataURL(file);

                // Синхронизация файла с <input type="file">
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                $(section.input)[0].files = dataTransfer.files;
            }

            function resetFileInput(index) {
                const section = sections[index];
                const prevSection = sections[index - 1];
                const nextSection = sections[index + 1];

                $(section.input).val('');
                $(section.img).attr('src', `{{ url('/image/no-image.png') }}`);
                $(section.span).html('Выберите файл').css({
                    color: "rgb(71 85 105)"
                });
                $(section.remove).hide();
                $(section.section).find('.flex.items-center').show();

                // Если удаляем последнее изображение, снова показываем эту секцию
                $(section.section).css({
                    display: "flex",
                    "flex-direction": "row"
                });

                // Скрыть следующие секции
                if (nextSection) {
                    for (let i = index + 1; i < sections.length; i++) {
                        $(sections[i].section).hide();
                        $(sections[i].input).val('');
                        $(sections[i].img).attr('src', `{{ url('/image/no-image.png') }}`);
                        $(sections[i].span).html('Выберите файл').css({
                            color: "rgb(71 85 105)"
                        });
                        $(sections[i].remove).hide();
                    }
                }

                // Показать кнопку "Удалить" в предыдущей секции
                if (prevSection) {
                    $(prevSection.remove).show();
                }
            }

            function enableDragAndDrop(index) {
                const section = sections[index];

                $(section.section).on('dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).css('background-color', '#f1f5f9'); // Подсветка
                });

                $(section.section).on('dragleave', function() {
                    $(this).css('background-color', ''); // Убираем подсветку
                });

                $(section.section).on('drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).css('background-color', '');

                    const files = e.originalEvent?.dataTransfer?.files || [];
                    if (files.length > 0) {
                        handleFileInput(files[0], index);
                    }
                });
            }

            sections.forEach((section, index) => {
                $(section.input).on('change', function() {
                    handleFileInput(this.files[0], index);
                });

                $(section.remove).on('click', function() {
                    resetFileInput(index);
                });

                enableDragAndDrop(index);
            });

        });
    </script>
@endsection
