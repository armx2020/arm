<div>
    <div class="pt-6 px-4 max-w-7xl mx-auto mb-4 flex flex-col">
        <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden">
                    <div class="relative w-full h-full md:h-auto">

                        <div class="bg-white rounded-lg relative">

                            <div class="flex items-start p-5 border-b rounded-t">
                                <div class="flex items-center">
                                    <h3 class="text-2xl font-bold leading-none text-gray-900">Новая сущность</h3>
                                </div>
                            </div>

                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.entity.store') }}">
                                @csrf

                                <div class="flex flex-row border-b" id="upload_area" wire:ignore>
                                    <div class="flex relative p-3">
                                        <img class="h-20 w-20 rounded-lg mx-4 my-2 object-cover" id="img"
                                            src="{{ url('/image/no-image.png') }}" alt="avatar">
                                        <button type="button" id="remove_image" class="absolute top-2 right-2"
                                            style="display: none;"><img src="{{ url('/image/remove.png') }}"
                                                class="w-5 h-5" style="cursor:pointer;"></button>
                                    </div>

                                    <div class="flex items-center">
                                        <label class="input-file relative inline-block">
                                            <input name="image" type="file" accept=".jpg,.jpeg,.png" id="image"
                                                class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                            <span
                                                class="relative inline-block align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                                style="cursor:pointer;">Выберите файл или перетащите сюда</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <x-input-error :messages="$errors->get('image')" />
                                </div>

                                <div class="p-6 space-y-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="col-span-6">
                                            <x-input-label for="name" :value="__('Название *')" />
                                            <x-text-input id="name" name="name" type="text"
                                                class="mt-1 block w-full bg-gray-50" :error="$errors->get('name')" :value="old('name')"
                                                required autofocus />
                                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                        </div>

                                        <x-admin.select-city />

                                        {{-- Тип сущности --}}
                                        <div class="col-span-6">
                                            <label for="selectedType"
                                                class="text-sm font-medium text-gray-900 block mb-2">Тип
                                                сущности</label>
                                            <select name="type" id="selectedType" wire:model.live="selectedType"
                                                required
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                                <option selected value=""> -- не выбрано --</option>
                                                @foreach ($typies as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-span-6">
                                            <label for="phone"
                                                class="text-sm font-medium text-gray-900 block mb-2">Телефон</label>
                                            <input type="tel" name="phone" id="phone" wire:ignore
                                                placeholder='+ 7 (***) ***-**-**'
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 mask-phone"
                                                value="{{ old('phone') }}">
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                        </div>

                                        <div class="col-span-6">
                                            <label for="address"
                                                class="text-sm font-medium text-gray-900 block mb-2">Адрес</label>
                                            <input type="text" name="address" id="address"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ old('address') }}">
                                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                        </div>

                                        @isset($this->selectedType)
                                            @if ($categories !== null && count($categories) > 0)
                                                <div class="col-span-6">
                                                    <label for="fields"
                                                        class="text-sm font-medium text-gray-900 block mb-2">Направление</label>
                                                    <div class="flex border-2 rounded-lg p-4  mt-1" id="checkbox-group">
                                                        <div class="grid grid-cols-3 gap-4 w-full">

                                                            @foreach ($categories as $item)
                                                                <div class="flex flex-col gap-1">
                                                                    <div class="flex">
                                                                        @if (count($item->categories) < 1)
                                                                            <input type="checkbox" name="fields[]"
                                                                                value="{{ $item->id }}"
                                                                                @if (is_array(old('fields')) && in_array($item->id, old('fields'))) checked @endif
                                                                                class="checkbox-{{ $loop->iteration }} shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                                                id="checkbox-{{ $loop->iteration }}">
                                                                            <label for="checkbox-{{ $loop->iteration }}"
                                                                                class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $item->name }}</label>
                                                                        @else
                                                                            <label
                                                                                for="checkbox-group-{{ $loop->iteration }}"
                                                                                class="text-base text-black ms-3 dark:text-neutral-400">{{ $item->name }}</label>
                                                                        @endif
                                                                    </div>
                                                                    @foreach ($item->categories as $child)
                                                                        <div class="flex">
                                                                            <input type="checkbox" name="fields[]"
                                                                                value="{{ $child->id }}"
                                                                                @if (is_array(old('fields')) && in_array($child->id, old('fields'))) checked @endif
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
                                                    <x-input-error class="mt-2" :messages="$errors->get('fields')" />
                                                </div>
                                            @endif
                                        @endisset

                                        {{-- Описание --}}
                                        <div class="col-span-6">
                                            <label for="description"
                                                class="text-sm font-medium text-gray-900 block mb-2">Описание</label>
                                            <textarea type="text" name="description" id="description"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">{{ old('description') ?? old('description') }}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>

                                        {{-- Пользователь --}}
                                        <x-admin.select-user />
                                    </div>

                                    {{-- Соц. ссылки --}}
                                    <hr class="my-5">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="col-span-6">
                                            <x-input-label for="web" :value="__('Веб')" />
                                            <x-text-input id="web" name="web" type="text"
                                                class="mt-1 block w-full bg-gray-50"
                                                placeholder='https://***********.**' :value="old('web')" />
                                            <x-input-error class="mt-2" :messages="$errors->get('web')" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input-label for="whatsapp" :value="__('Whatsapp')" />
                                            <x-text-input id="whatsapp" name="whatsapp" type="text"
                                                class="mt-1 block w-full bg-gray-50"
                                                placeholder='https://wa.me/***********' :value="old('whatsapp')" />
                                            <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input-label for="telegram" :value="__('Телеграм')" />
                                            <x-text-input id="telegram" name="telegram" type="text"
                                                class="mt-1 block w-full bg-gray-50" placeholder='https://t.me/******'
                                                :value="old('telegram')" />
                                            <x-input-error class="mt-2" :messages="$errors->get('telegram')" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input-label for="vkontakte" :value="__('Вконтакте')" />
                                            <x-text-input id="vkontakte" name="vkontakte" type="text"
                                                class="mt-1 block w-full bg-gray-50"
                                                placeholder='https://vk.com/***********' :value="old('vkontakte')" />
                                            <x-input-error class="mt-2" :messages="$errors->get('vkontakte')" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input-label for="instagram" :value="__('Инстаграм')" />
                                            <x-text-input id="instagram" name="instagram" type="text"
                                                class="mt-1 block w-full bg-gray-50"
                                                placeholder='https://instagram.com/*******' :value="old('instagram')" />
                                            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                                        </div>

                                    </div>

                                    <div class="items-center py-6 border-gray-200 rounded-b">
                                        <button
                                            class="text-white w-full bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                            type="submit">Добавить</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
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
    </script>
    @vite(['resources/js/mask_phone.js'])
</div>
