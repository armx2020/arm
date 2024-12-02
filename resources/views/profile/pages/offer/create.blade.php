@extends('layouts.app')
@section('content')
    <div class="flex flex-col lg:flex-row mx-auto my-10">

        <x-nav-profile page="mycompanies"></x-nav-profile>

        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
            <div class="flex flex-col basis-full">
                <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-2 lg:p-10 relative">
                    <form method="post" action="{{ route('myoffers.store') }}" class="w-full" enctype="multipart/form-data">
                        @csrf

                        <div class="w-full mb-3">
                            <h2 class="text-xl">Добавить предложение</h2>
                        </div>

                        <div class="flex flex-row" id="upload_area">
                            <!-- image  -->
                            <div class="flex flex-row" id="image-section">
                                <div class="flex relative">
                                    <img class="h-12 w-12 rounded-lg m-1 object-cover" id="img"
                                        src="{{ url('/image/no-image.png') }}" alt="image">
                                    <button type="button" id="remove_image" class="absolute right-0 hidden"><img
                                            src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>
                                <div class="flex items-center" id="title_image">
                                    <label class="relative inline-block">
                                        <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span"
                                            class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                            style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                    </label>
                                </div>
                            </div>

                            <!-- image 1 -->
                            <div class="hidden flex-row" id="image1-section">
                                <div class="flex relative">
                                    <img class="h-12 w-12 rounded-lg m-1 object-cover" id="img1"
                                        src="{{ url('/image/no-image.png') }}" alt="image">
                                    <button type="button" id="remove_image1" class="absolute right-0 hidden"><img
                                            src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>
                                <div class="flex items-center" id="title_image1">
                                    <label class="relative inline-block">
                                        <input name="image1" type="file" accept=".jpg,.jpeg,.png" id="image1"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span1"
                                            class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                            style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                    </label>
                                </div>
                            </div>

                            <!-- image 2 -->
                            <div class="hidden flex-row" id="image2-section">
                                <div class="flex relative">
                                    <img class="h-12 w-12 rounded-lg m-1 object-cover" id="img2"
                                        src="{{ url('/image/no-image.png') }}" alt="image">
                                    <button type="button" id="remove_image2" class="absolute  right-0 hidden"><img
                                            src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>
                                <div class="flex items-center" id="title_image2">
                                    <label class="relative inline-block">
                                        <input name="image2" type="file" accept=".jpg,.jpeg,.png" id="image2"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span2"
                                            class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                            style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                    </label>
                                </div>
                            </div>

                            <!-- image 3 -->
                            <div class="hidden flex-row" id="image3-section">
                                <div class="flex relative">
                                    <img class="h-12 w-12 rounded-lg m-1 object-cover" id="img3"
                                        src="{{ url('/image/no-image.png') }}" alt="image">
                                    <button type="button" id="remove_image3" class="absolute  right-0 hidden"><img
                                            src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>
                                <div class="flex items-center" id="title_image3">
                                    <label class="relative inline-block">
                                        <input name="image3" type="file" accept=".jpg,.jpeg,.png" id="image3"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span3"
                                            class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                            style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                    </label>
                                </div>
                            </div>

                            <!-- image 4 -->
                            <div class="hidden flex-row" id="image4-section">
                                <div class="flex relative">
                                    <img class="h-12 w-12 rounded-lg m-4 object-cover" id="img4"
                                        src="{{ url('/image/no-image.png') }}" alt="image">
                                    <button type="button" id="remove_image4" class="absolute  right-0 hidden"><img
                                            src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                            style="cursor:pointer;"></button>
                                </div>
                                <div class="flex items-center" id="title_image4">
                                    <label class="relative inline-block">
                                        <input name="image4" type="file" accept=".jpg,.jpeg,.png" id="image4"
                                            class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                        <span id="image_span4"
                                            class="relative inline-block bg-slate-100 align-middle text-center p-2 rounded-lg w-full text-slate-600"
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
                                :value="old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="address" :value="__('Адрес')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address')" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="description" :value="__('Описание')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                :value="old('description')" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="my-3">
                            <label for="company" class="text-sm font-medium text-gray-900 block mb-2">Компания</label>
                            <select name="company" id="company"
                                class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"
                                required>
                                <option value="" checked> -- Выберите компанию -- </option>
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
                            <label for="category" class="text-sm font-medium text-gray-900 block mb-2">Категория *</label>
                            <select name="category" id="category"
                                class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"
                                required>
                                <option value="" checked> -- Выберите категорию -- </option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @disabled(count($category->childrenCategories) > 0)
                                        class="font-semibold text-ellipsis overflow-hidden text-nowrap">
                                        {{ mb_substr($category->name, 0, 80, 'UTF-8') }}
                                        @if (mb_strlen($category->name) > 80)
                                            ...
                                        @endif
                                    </option>
                                    @foreach ($category->childrenCategories as $item)
                                        <option value="{{ $item->id }}"
                                            class="pl-6 text-ellipsis overflow-hidden text-nowrap">
                                            {{ mb_substr($item->name, 0, 80, 'UTF-8') }}
                                            @if (mb_strlen($item->name) > 80)
                                                ...
                                            @endif
                                        </option>
                                    @endforeach
                                @endforeach

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

    <script type='text/javascript'>
        $(document).ready(function() {
            const maxSize = 2000000;

            const sections = [{
                    input: '#image',
                    img: '#img',
                    span: '#image_span',
                    remove: '#remove_image',
                    section: '#image-section'
                },
                {
                    input: '#image1',
                    img: '#img1',
                    span: '#image_span1',
                    remove: '#remove_image1',
                    section: '#image1-section'
                },
                {
                    input: '#image2',
                    img: '#img2',
                    span: '#image_span2',
                    remove: '#remove_image2',
                    section: '#image2-section'
                },
                {
                    input: '#image3',
                    img: '#img3',
                    span: '#image_span3',
                    remove: '#remove_image3',
                    section: '#image3-section'
                },
                {
                    input: '#image4',
                    img: '#img4',
                    span: '#image_span4',
                    remove: '#remove_image4',
                    section: '#image4-section'
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

                sections.forEach((s, i) => {
                    if (i !== index) $(s.remove).hide();
                });

                $(section.remove).show();

                if (nextSection) {
                    $(nextSection.section).css({
                        display: "flex",
                        "flex-direction": "row"
                    });
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    $(section.img).attr('src', event.target.result);
                };
                reader.readAsDataURL(file);

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
                $(section.span).html('Выберите файл или перетащите сюда').css({
                    color: "rgb(71 85 105)"
                });
                $(section.remove).hide();
                $(section.section).find('.flex.items-center').show();


                $(section.section).css({
                    display: "flex",
                    "flex-direction": "row"
                });

                if (nextSection) {
                    for (let i = index + 1; i < sections.length; i++) {
                        $(sections[i].section).hide();
                        $(sections[i].input).val('');
                        $(sections[i].img).attr('src', `{{ url('/image/no-image.png') }}`);
                        $(sections[i].span).html('Выберите файл или перетащите сюда').css({
                            color: "rgb(71 85 105)"
                        });
                        $(sections[i].remove).hide();
                    }
                }

                if (prevSection) {
                    $(prevSection.remove).show();
                }
            }

            function enableDragAndDrop(index) {
                const section = sections[index];

                $(section.section).on('dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).css('background-color', '#f1f5f9');
                });

                $(section.section).on('dragleave', function() {
                    $(this).css('background-color', '');
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
