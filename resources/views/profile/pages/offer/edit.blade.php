@extends('layouts.app')
@section('content')
    <div class="flex flex-col lg:flex-row mx-auto my-10">

        @include('profile.menu')

        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
            <div class="flex flex-col basis-full">
                <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
                    <form method="post" action="{{ route('myoffers.update', ['myoffer' => $offer->id]) }}" class="w-full"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input name="image_remove_1" type="text" id="image_remove_1" class="hidden" style="z-index:-10;" />
                        <input name="image_remove_2" type="text" id="image_remove_2" class="hidden"
                            style="z-index:-10;" />
                        <input name="image_remove_3" type="text" id="image_remove_3" class="hidden"
                            style="z-index:-10;" />
                        <input name="image_remove_4" type="text" id="image_remove_4" class="hidden"
                            style="z-index:-10;" />

                        <div class="w-full">
                            <h2 class="text-xl">Редактировать товар</h2>
                            <hr class="w-full h-2 my-2">
                        </div>

                        @php
                            $images = $offer->images()->get();
                        @endphp

                        <div class="flex flex-row border-b" wire:ignore>

                            <!-- image  -->
                            <div class="flex flex-row" id="upload_area">

                                <div class="flex relative p-3">
                                    <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img" alt="image"
                                        @if (empty($offer->image)) src="{{ url('/image/no-image.png') }}" @else src="{{ asset('storage/' . $offer->image) }}" @endif>

                                    <button type="button" id="remove_image" class="absolute top-2 right-2"
                                        @if (isset($offer->image) && empty($images[0])) style="display: block;" @else style="display: none;" @endif>

                                        <img src="{{ url('/image/remove.png') }}" class="w-5 h-5" style="cursor:pointer;">
                                    </button>
                                </div>

                                <div class="items-center" id="title_image"
                                    @if (empty($offer->image)) style="display: flex;" @else style="display: none;" @endif>

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
                            <div class="flex flex-row" id="upload_area_1"
                                @if (empty($offer->image)) style="display: none;" @else style="display: flex;" @endif>

                                <div class="flex relative p-3">
                                    <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img_1" alt="image"
                                        @if (empty($images[0])) src="{{ url('/image/no-image.png') }}" @else src="{{ asset('storage/' . $images[0]->path) }}" @endif>

                                    <button type="button" id="remove_image_1" class="absolute top-2 right-2"
                                        @if (isset($images[0]) && empty($images[1])) style="display: block;" @else style="display: none;" @endif>

                                        <img src="{{ url('/image/remove.png') }}" class="w-5 h-5" style="cursor:pointer;">
                                    </button>
                                </div>

                                <div class="items-center" id="title_image_1"
                                    @if (empty($images[0])) style="display: flex;" @else style="display: none;" @endif>

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
                            <div class="flex-row" id="upload_area_2"
                                @if (empty($images[0])) style="display: none;" @else style="display: flex;" @endif>

                                <div class="flex relative p-3">

                                    <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img_2" alt="image"
                                        @if (empty($images[1])) src="{{ url('/image/no-image.png') }}" @else src="{{ asset('storage/' . $images[1]->path) }}" @endif>

                                    <button type="button" id="remove_image_2" class="absolute top-2 right-2"
                                        @if (isset($images[1]) && empty($images[2])) style="display: block;" @else style="display: none;" @endif>

                                        <img src="{{ url('/image/remove.png') }}" class="w-5 h-5" style="cursor:pointer;">
                                    </button>
                                </div>

                                <div class="items-center" id="title_image_2"
                                    @if (empty($images[1])) style="display: flex;" @else style="display: none;" @endif>

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
                            <div class="flex-row" id="upload_area_3"
                                @if (empty($images[1])) style="display: none;" @else style="display: flex;" @endif>
                                <div class="flex relative p-3">

                                    <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img_3" alt="image"
                                        @if (empty($images[2])) src="{{ url('/image/no-image.png') }}" @else src="{{ asset('storage/' . $images[2]->path) }}" @endif>

                                    <button type="button" id="remove_image_3" class="absolute top-2 right-2"
                                        @if (isset($images[2]) && empty($images[3])) style="display: block;" @else style="display: none;" @endif>

                                        <img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;">
                                    </button>
                                </div>

                                <div class="items-center" id="title_image_3"
                                    @if (empty($images[2])) style="display: flex;" @else style="display: none;" @endif>

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
                            <div class="flex-row" id="upload_area_4"
                                @if (empty($images[2])) style="display: none;" @else style="display: flex;" @endif>

                                <div class="flex relative p-3">

                                    <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img_4" alt="image"
                                        @if (empty($images[3])) src="{{ url('/image/no-image.png') }}" @else src="{{ asset('storage/' . $images[3]->path) }}" @endif>

                                    <button type="button" id="remove_image_4" class="absolute top-2 right-2"
                                        @if (isset($images[3])) style="display: block;" @else style="display: none;" @endif>

                                        <img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;">
                                    </button>
                                </div>

                                <div class="items-center" id="title_image_4"
                                    @if (empty($images[3])) style="display: flex;" @else style="display: none;" @endif>

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
                            <x-input-label for="name" :value="__('Название *')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $offer->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="address" :value="__('Адрес')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $offer->address)" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="description" :value="__('Описание')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                :value="old('description', $offer->description)" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="my-3">
                            <label for="entity" class="text-sm font-medium text-gray-900 block mb-2">Компания</label>
                            <select name="entity" id="entity"
                                class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"
                                required>
                                @if ($offer->entity)
                                    <option value="{{ $offer->entity->id }}">
                                        {{ mb_substr($offer->entity->name, 0, 80, 'UTF-8') }}
                                        @if (mb_strlen($offer->entity->name) > 80)
                                            ...
                                        @endif
                                    </option>
                                @else
                                    <option value=""> -- Выберите компанию -- </option>
                                @endif
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        class="text-ellipsis overflow-hidden text-nowrap">
                                        {{ mb_substr($company->name, 0, 80, 'UTF-8') }}
                                        @if (mb_strlen($company->name) > 80)
                                            ...
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-3">
                            <x-input-label for="checkbox-group" :value="__('Выберите деятельность *')" />
                            <div class="flex border-2 rounded-lg p-4  mt-1" id="checkbox-group">
                                <div class="grid grid-cols-3 gap-4 w-full">

                                    @foreach ($categories as $item)
                                        <div class="flex flex-col gap-1">
                                            <div class="flex">
                                                <label for="checkbox-group-{{ $loop->iteration }}"
                                                    class="text-base text-black ms-3 dark:text-neutral-400">{{ $item->name }}</label>
                                            </div>
                                            @foreach ($item->categories as $child)
                                                <div class="flex">
                                                    <input type="radio" name="category" value="{{ $child->id }}"
                                                        @checked($offer->category_id == $child->id)
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
                            <x-input-error class="mt-2" :messages="$errors->get('categories')" />
                        </div>

                        <div class="my-3">
                            <label for="city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                            <select name="city" class="w-full" style="border-color: rgb(209 213 219)" id="city">
                                <option value='{{ $offer->city->id }}'>{{ $offer->city->name }}</option>
                            </select>
                        </div>

                        <div class="flex items-center gap-4 my-6">
                            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                        </div>
                    </form>
                </div>

                <div class="flex basis-full bg-gray-200 rounded-md p-3 my-6">
                    <form method="post" action="{{ route('myoffers.destroy', ['myoffer' => $offer->id]) }}"
                        class="w-full text-center">
                        @csrf
                        @method('delete')

                        <div class="m-2 flex flex-row justify-between basis-full">
                            <div class="text-lg font-medium text-gray-900 flex">
                                {{ __('Чтобы удалить, нажмите') }}
                            </div>
                            <x-danger-button class="flex">
                                {{ __('Удалить') }}
                            </x-danger-button>
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

            const maxSize = 2000000; // 2 MB

            function updatePreview(input, imgSelector, spanSelector, sectionSelector,
                removeBtnSelectorShow,
                removeBtnSelectorHide, nextSectionSelector) {
                const file = input.files[0];
                if (file.size > maxSize) {
                    $(spanSelector).html('Максимальный размер 2 МБ').css("color", "rgb(239 68 68)");
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    $(imgSelector).attr('src', e.target.result);
                };
                reader.readAsDataURL(file);

                $(spanSelector).html(file.name).css("color", "rgb(71 85 105)");
                $(sectionSelector).css("display", "none");
                $(removeBtnSelectorHide).css("display", "none");
                $(removeBtnSelectorShow).css("display", "block");
                $(nextSectionSelector).css({
                    "display": "flex",
                    "flex-direction": "row"
                });
            }

            function removeFile(inputSelector, imgSelector, spanSelector, sectionSelector,
                removeBtnSelectorShow, removeBtnSelectorHide, prevSectionSelector, imageDelete) {
                $(inputSelector).val('');
                $(imgSelector).attr('src', `{{ url('/image/no-image.png') }}`);
                $(spanSelector).html('Выберите файл или перетащите сюда').css("color",
                    "rgb(71 85 105)");
                $(sectionSelector).css("display", "none");
                $(removeBtnSelectorHide).css("display", "none");
                $(imageDelete).val('delete');
                if (removeBtnSelectorShow) {
                    $(removeBtnSelectorShow).css("display", "block");
                }

                if (prevSectionSelector) {
                    $(prevSectionSelector).css({
                        "display": "flex",
                        "flex-direction": "row"
                    });
                }
            }

            // image
            $('#image').on('change', function() {
                updatePreview(this, '#img', '#image_span', '#title_image', '#remove_image',
                    null,
                    '#upload_area_1');
            });

            $('#remove_image').on('click', function() {
                removeFile('#image', '#img', '#image_span', '#upload_area_1', null,
                    '#remove_image',
                    '#upload_area, #title_image', '#image_remove');
            });

            // image 1
            $('#image_1').on('change', function() {
                updatePreview(this, '#img_1', '#image_span_1', '#title_image_1',
                    '#remove_image_1',
                    '#remove_image', '#upload_area_2');
            });
            $('#remove_image_1').on('click', function() {
                removeFile('#image_1', '#img_1', '#image_span_1', '#upload_area_2',
                    '#remove_image',
                    '#remove_image_1', '#upload_area_1, #title_image_1', '#image_remove_1');
            });

            // image 2
            $('#image_2').on('change', function() {
                updatePreview(this, '#img_2', '#image_span_2', '#title_image_2',
                    '#remove_image_2',
                    '#remove_image_1', '#upload_area_3');
            });
            $('#remove_image_2').on('click', function() {
                removeFile('#image_2', '#img_2', '#image_span_2', '#upload_area_3',
                    '#remove_image_1',
                    '#remove_image_2', '#upload_area_2, #title_image_2', '#image_remove_2');
            });

            // image 3
            $('#image_3').on('change', function() {
                updatePreview(this, '#img_3', '#image_span_3', '#title_image_3',
                    '#remove_image_3',
                    '#remove_image_2', '#upload_area_4');
            });
            $('#remove_image_3').on('click', function() {
                removeFile('#image_3', '#img_3', '#image_span_3', '#upload_area_4',
                    '#remove_image_2',
                    '#remove_image_3', '#upload_area_3, #title_image_3', '#image_remove_3');
            });

            // image 4
            $('#image_4').on('change', function() {
                updatePreview(this, '#img_4', '#image_span_4', '#title_image_4',
                    '#remove_image_4',
                    '#remove_image_3', null);
            });
            $('#remove_image_4').on('click', function() {
                removeFile('#image_4', '#img_4', '#image_span_4', null, '#remove_image_3',
                    '#remove_image_4', '#upload_area_4, #title_image_4', '#image_remove_4');
            });


            ['#upload_area', '#upload_area_1', '#upload_area_2', '#upload_area_3', '#upload_area_4']
            .forEach(
                function(sectionId) {
                    const dropArea = $(sectionId);

                    dropArea.on('dragover', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        $(this).addClass('bg-slate-100');
                    });

                    dropArea.on('dragleave', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        $(this).removeClass('bg-slate-100');
                    });

                    dropArea.on('drop', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        $(this).removeClass('bg-slate-100');

                        const files = e.originalEvent.dataTransfer.files;
                        if (files.length > 0) {
                            const currentInput = $(this).find('input[type="file"]:visible')
                                .get(0);
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(files[0]);
                            currentInput.files = dataTransfer.files;
                            $(currentInput).trigger('change');
                        }
                    });
                });
        });
    </script>
@endsection
