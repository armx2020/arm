@extends('layouts.app')

@section('title')
    <title>Исправить неточность - {{ $entity->name }}
    </title>
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

                <h3 class="text-xl font-semibold">Исправить неточность - <br>{{ $entity->name }}</h3>
                <p class="text-sm my-1">Опишите нам что исправить</p>
                <hr class="mt-4">

                <!-- Session Status -->

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('entity.update', ['idOrTranscript' => $entity->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    @if (session('error'))
                        <x-input-error :messages="session('error')" class="mt-2 mb-3" />
                    @endif

                    <div class="flex flex-row border-b" >

                         <!-- image 1 -->
                        <div class="flex flex-row" id="upload_area_1" >
                            <div class="flex relative">
                                <img class="h-14 w-14 rounded-lg m-2 object-cover" id="img_1"
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
                                        style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                        <!-- image 2 -->
                        <div class="hidden flex flex-row" id="upload_area_2" >
                            <div class="flex relative">
                                <img class="h-14 w-14 rounded-lg m-2 object-cover" id="img_2"
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
                                        style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                        <!-- image 3 -->
                        <div class="hidden flex flex-row" id="upload_area_3" >
                            <div class="flex relative">
                                <img class="h-14 w-14 rounded-lg m-2 object-cover" id="img_3"
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
                                        style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                        <!-- image 4 -->
                        <div class="hidden flex flex-row" id="upload_area_4" >
                            <div class="flex relative">
                                <img class="h-14 w-14 rounded-lg m-2 object-cover" id="img_4"
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
                                        style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                         <!-- image 5 -->
                         <div class="hidden flex flex-row" id="upload_area_5" >
                            <div class="flex relative">
                                <img class="h-14 w-14 rounded-lg m-2 object-cover" id="img_5"
                                    src="{{ url('/image/no-image.png') }}" alt="avatar">
                                <button type="button" id="remove_image_5" class="absolute top-2 right-2"
                                    style="display: none;"><img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                        style="cursor:pointer;"></button>
                            </div>

                            <div class="flex items-center">
                                <label class="input-file relative inline-block">
                                    <input name="image_5" type="file" accept=".jpg,.jpeg,.png" id="image_5"
                                        class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                    <span id="image_span_5"
                                        class="relative inline-block align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                        style="cursor:pointer;">Выберите файл</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- name -->
                    <div class="mt-4">
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" placeholder="Ваше имя" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- phone -->
                    <div class="mt-4">
                        <x-text-input id="phone" class="block mt-1 w-full mask-phone" type="text" name="phone"
                            :value="old('phone')" placeholder="Ваш телефон" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>


                    <!-- message -->
                    <div class="mt-4">
                        <textarea id="message"
                            class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="text"
                            name="message" :value="old('message')" placeholder="Сообщение"></textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-center mt-4">

                        <div class="flex items-center justify-end">
                            <x-primary-button class="px-3">
                                {{ __('отправить') }}
                            </x-primary-button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {

            // Максимальный размер файла – 2 МБ
            const maxSize = 2000000;

            const sections = [
                { input: '#image_1',  img: '#img_1',  span: '#image_span_1',  remove: '#remove_image_1',  section: '#upload_area_1' },
                { input: '#image_2',  img: '#img_2',  span: '#image_span_2',  remove: '#remove_image_2',  section: '#upload_area_2' },
                { input: '#image_3',  img: '#img_3',  span: '#image_span_3',  remove: '#remove_image_3',  section: '#upload_area_3' },
                { input: '#image_4',  img: '#img_4',  span: '#image_span_4',  remove: '#remove_image_4',  section: '#upload_area_4' },
                { input: '#image_5',  img: '#img_5',  span: '#image_span_5',  remove: '#remove_image_5',  section: '#upload_area_5' }
            ];

            function handleFileInput(file, index) {
                if (!file) return;
                const section = sections[index];

                if (file.size > maxSize) {
                    $(section.span).html('Максимальный размер 2 МБ').css({ color: "rgb(239 68 68)" });
                    return;
                }

                $(section.span).html(file.name).css({ color: "rgb(71 85 105)" });
                $(section.section).find('.flex.items-center').hide();

                $(section.remove).show();

                const reader = new FileReader();
                reader.onload = function(event) {
                    $(section.img).attr('src', event.target.result);
                };
                reader.readAsDataURL(file);

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                $(section.input)[0].files = dataTransfer.files;

                if (index < sections.length - 1) {
                    $(sections[index + 1].section).css({
                        display: "flex",
                        "flex-direction": "row"
                    });
                }
            }

            function setSectionFile(index, file) {
                const section = sections[index];
                if (!file) return;
                if (file.size > maxSize) {
                    $(section.span).html('Максимальный размер 2 МБ').css({ color: "rgb(239 68 68)" });
                    return;
                }
                $(section.span).html(file.name).css({ color: "rgb(71 85 105)" });
                $(section.section).find('.flex.items-center').hide();
                $(section.remove).show();

                const reader = new FileReader();
                reader.onload = function(event) {
                    $(section.img).attr('src', event.target.result);
                };
                reader.readAsDataURL(file);

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                $(section.input)[0].files = dataTransfer.files;

                if (index < sections.length - 1) {
                    $(sections[index + 1].section).css({
                        display: "flex",
                        "flex-direction": "row"
                    });
                }
            }

            function resetSection(index) {
                const section = sections[index];
                $(section.input).val('');
                $(section.img).attr('src', `{{ url('/image/no-image.png') }}`);
                $(section.span).html('Выберите файл').css({ color: "rgb(71 85 105)" });
                $(section.remove).hide();
                $(section.section).find('.flex.items-center').show();
            }

            function deleteImageAtIndex(index) {
                for (let i = index; i < sections.length - 1; i++) {
                    if ($(sections[i + 1].input)[0].files.length > 0) {
                        let file = $(sections[i + 1].input)[0].files[0];
                        setSectionFile(i, file);
                    } else {
                        resetSection(i);
                        for (let j = i + 1; j < sections.length; j++) {
                            $(sections[j].section).hide();
                            resetSection(j);
                        }
                        return;
                    }
                }
                resetSection(sections.length - 1);
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
                    deleteImageAtIndex(index);
                });

                enableDragAndDrop(index);
            });

        });
    </script>

@endsection

@section('body')
    @vite(['resources/js/mask_phone.js'])
@endsection
