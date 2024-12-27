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
                        <input name="image_remove" type="text" id="image_remove" class="hidden" style="z-index:-10;" />

                        <div class="w-full">
                            <h2 class="text-xl">Редактировать товар</h2>
                            <hr class="w-full h-2 my-2">
                        </div>

                        <div class="flex flex-row" id="upload_area">
                            <div class="flex relative">
                                @if ($offer->image == null)
                                    <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img"
                                        src="{{ url('/image/no-image.png') }}" alt="image">
                                @else
                                    <img class="h-20 w-20 rounded-lg m-4 object-cover" id="img"
                                        src="{{ asset('storage/' . $offer->image) }}" alt="image">
                                @endif
                                <button type="button" id="remove_image" class="absolute top-5 right-5"
                                    @if ($offer->image == null) style="display: none;"
                                @else
                                style="display: block;" @endif><img
                                        src="{{ url('/image/remove.png') }}" class="w-5 h-5" style="cursor:pointer;">
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
                                <option value="{{ $offer->entity->id }}">
                                    {{ mb_substr($offer->entity->name, 0, 80, 'UTF-8') }}
                                    @if (mb_strlen($offer->entity->name) > 80)
                                        ...
                                    @endif
                                </option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" class="text-ellipsis overflow-hidden text-nowrap">
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
                                                        id="checkbox-{{ $loop->iteration }}">
                                                    <label for="checkbox-{{ $loop->iteration }}"
                                                        class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $child->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('categories')" />
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
    <script type='text/javascript'>
        $(document).ready(function() {
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
