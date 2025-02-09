<div>
    <div class="pt-6 px-4 max-w-7xl mx-auto mb-4 flex flex-col">
        <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden">
                    <div class="relative w-full h-full md:h-auto">

                        @if (session('success'))
                            <div class="my-4 bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="bg-white rounded-lg relative">
                            <form id="entity_delete_form" action="{{ route('admin.entity.destroy', $entity->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                            </form>

                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.entity.update', ['entity' => $entity->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="flex justify-between p-5 border-b rounded-t">
                                    <div class="flex items-center">
                                        <h3 class="text-2xl font-bold leading-none text-gray-900">
                                            {{ $entity->name }}</h3>
                                    </div>
                                    <div class="flex items-center pl-7">
                                        @if (isset($duplicateExists) && $duplicateExists == true)
                                            <div
                                                class="mr-5 text-white bg-orange-700 font-medium rounded-lg text-sm px-2 px-3 py-2 text-center">
                                                Дубль
                                            </div>
                                        @endif
                                        @if ($entity->top == 1)
                                            <div
                                                class="mr-5 text-white bg-sky-600 font-medium rounded-lg text-sm px-2 px-3 py-2 text-center">
                                                Топ
                                            </div>
                                        @endif
                                        <div class="pr-5">
                                            <label for="activity" class="inline-flex">
                                                <div>
                                                    <input id="activity" type="checkbox" @checked($entity->activity)
                                                        value="1"
                                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                        name="activity">
                                                </div>
                                                <span class="ml-2 text-gray-700">Активность</span>
                                            </label>
                                        </div>
                                        <button id="entity_delete" type="button"
                                            class="pr-5 text-gray-700">Удалить</button>
                                        <a class="text-gray-700 whitespace-nowrap"
                                            href="https://ya.ru/search/?text={{ $entity->name }}" target="_blank">
                                            перейти в яндекс</a>
                                    </div>
                                </div>

                                @for ($i = 1; $i < 21; $i++)
                                    <input name="image_remove_{{ $i }}" type="text"
                                        id="image_remove_{{ $i }}" class="hidden" style="z-index:-10;" />
                                @endfor


                                @php
                                    $images = $entity->images()->withoutGlobalScopes()->get();
                                @endphp

                                <div class="flex flex-wrap gap-4 border-b pb-3" wire:ignore>

                                    @for ($i = 1, $k = 0, $t = -1; $i < 21; $i++, $k++, $t++)
                                        <div class="flex flex-row" id="upload_area_{{ $i }}"
                                            @if (empty($images[$t]) && $i !== 1) style="display: none;" @else style="display: flex;" @endif>

                                            <div class="flex flex-col relative p-3">
                                                <img class="h-20 w-20 rounded-lg m-4 object-cover"
                                                    id="img_{{ $i }}" alt="image"
                                                    @if (empty($images[$k])) src="{{ url('/image/no-image.png') }}" @else src="{{ asset('storage/' . $images[$k]->path) }}" @endif>

                                                <div class="mx-auto">
                                                    <label for="activity_img_{{ $i }}" class="inline-flex">
                                                        <div>
                                                            <input id="activity_img_{{ $i }}"
                                                                type="checkbox" @checked(isset($images[$k]) && $images[$k]->activity)
                                                                value="1"
                                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                                name="activity_img_{{ $i }}">
                                                        </div>
                                                        <span class="ml-2 text-gray-700">активное</span>
                                                    </label>
                                                </div>

                                                <button type="button" id="remove_image_{{ $i }}"
                                                    class="absolute top-2 right-2"
                                                    @if (empty($images[$k])) style="display: none;" @else style="display: flex;" @endif>

                                                    <img src="{{ url('/image/remove.png') }}" class="w-5 h-5"
                                                        style="cursor:pointer;">
                                                </button>
                                            </div>

                                            <div class="flex items-center"
                                                @if (empty($images[$k])) style="display: flex;" @else style="display: none;" @endif>

                                                <label class="input-file relative inline-block">
                                                    <input name="image_{{ $i }}" type="file"
                                                        accept=".jpg,.jpeg,.png" id="image_{{ $i }}"
                                                        class="absolute opacity-0 block w-0 h-0" style="z-index:-1;" />
                                                    <span id="image_span_{{ $i }}"
                                                        class="relative inline-block align-middle text-center p-2 rounded-lg w-full text-slate-600"
                                                        style="cursor:pointer;">Выберите файл</span>
                                                </label>
                                            </div>

                                        </div>
                                    @endfor

                                </div>

                                <div>
                                    <x-input-error :messages="$errors->get('image')" />
                                </div>

                                <div class="p-6 space-y-6">
                                    <div class="grid grid-cols-6 gap-4">

                                        {{-- Название --}}
                                        <div class="col-span-6 md:col-span-2">
                                            <label for="name"
                                                class="text-sm font-medium text-gray-900 block mb-2">Название *</label>
                                            <input type="text" name="name" id="name"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ old('name', $entity->name) }}" required autofocus>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>

                                        {{-- Город --}}
                                        <div class="col-span-6 md:col-span-2" id="city_div" wire:ignore>
                                            <x-admin.select-city :selectedCity="$entity->city" />
                                        </div>

                                        {{-- Адрес --}}
                                        <div class="col-span-6 md:col-span-2">
                                            <label for="address"
                                                class="text-sm font-medium text-gray-900 block mb-2">Адрес</label>
                                            <input type="text" name="address" id="address"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value="{{ old('address', $entity->address) }}">
                                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                        </div>

                                        {{-- Телефон --}}
                                        <div class="col-span-6 ms:col-span-3">
                                            <label for="phone"
                                                class="text-sm font-medium text-gray-900 block mb-2">Телефон</label>
                                            <input type="tel" name="phone" id="phone" wire:ignore
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 mask-phone"
                                                value="{{ old('phone', $entity->phone) }}">
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                        </div>

                                        {{-- Тип сущности --}}
                                        <div class="col-span-6 ms:col-span-3">
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

                                        {{-- Направления --}}
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
                                                                                @checked($entity->fields->contains($item->id))
                                                                                @if (is_array(old('fields')) && in_array($item->id, old('fields'))) checked @endif
                                                                                class="checkbox-{{ $loop->iteration }} shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                                                id="checkbox-{{ $item->id }}">
                                                                            <label for="checkbox-{{ $item->id }}"
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
                                                                                @checked($entity->fields->contains($child->id))
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
                                                    <x-input-error class="mt-2" :messages="$errors->get('fields')" />
                                                </div>
                                            @endif
                                        @endisset

                                        {{-- Описание --}}
                                        <div class="col-span-6">
                                            <label for="description"
                                                class="text-sm font-medium text-gray-900 block mb-2">Описание</label>
                                            <textarea type="text" name="description" id="description"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">{{ old('description', $entity->description) }}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>

                                        {{-- Сортировка --}}
                                        <div class="col-span-6">
                                            <label for="sort_id"
                                                class="text-sm font-medium text-gray-900 block mb-2">Сортировка
                                                *</label>
                                            <input type="number" name="sort_id" id="sort_id"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                                value={{ old('sort_id', $entity->sort_id) }} required>
                                            <x-input-error :messages="$errors->get('sort_id')" class="mt-2" />
                                        </div>

                                        {{-- Пользователь --}}
                                        <x-admin.select-user :selectedUser="$entity->user" />
                                    </div>

                                    {{-- Соц. ссылки --}}
                                    <hr class="my-5">
                                    <div class="grid grid-cols-6 gap-4">

                                        <div class="col-span-6">
                                            <x-input-label for="web" :value="__('Веб')" />
                                            <x-text-input id="web" name="web" type="text"
                                                class="mt-1 block w-full bg-gray-50"
                                                placeholder='https://***********.**' :value="old('web', $entity->web)" />
                                            <x-input-error class="mt-2" :messages="$errors->get('web')" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input-label for="whatsapp" :value="__('Whatsapp')" />
                                            <x-text-input id="whatsapp" name="whatsapp" type="text"
                                                class="mt-1 block w-full bg-gray-50"
                                                placeholder='https://wa.me/***********' :value="old('whatsapp', $entity->whatsapp)" />
                                            <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input-label for="telegram" :value="__('Телеграм')" />
                                            <x-text-input id="telegram" name="telegram" type="text"
                                                class="mt-1 block w-full bg-gray-50" placeholder='https://t.me/******'
                                                :value="old('telegram', $entity->telegram)" />
                                            <x-input-error class="mt-2" :messages="$errors->get('telegram')" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input-label for="vkontakte" :value="__('Вконтакте')" />
                                            <x-text-input id="vkontakte" name="vkontakte" type="text"
                                                class="mt-1 block w-full bg-gray-50"
                                                placeholder='https://vk.com/***********' :value="old('vkontakte', $entity->vkontakte)" />
                                            <x-input-error class="mt-2" :messages="$errors->get('vkontakte')" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-input-label for="instagram" :value="__('Инстаграм')" />
                                            <x-text-input id="instagram" name="instagram" type="text"
                                                class="mt-1 block w-full bg-gray-50"
                                                placeholder='https://instagram.com/*******' :value="old('instagram', $entity->instagram)" />
                                            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                                        </div>

                                    </div>

                                    <hr class="my-5">
                                    <div class="items-center pb-6 border-gray-200 rounded-b">
                                        <div class="col-span-6">
                                            <div class="flex w-full justify-end">
                                                <button
                                                    class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                                    type="submit">ОБНОВИТЬ</button>
                                            </div>

                                        </div>
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
        $(document).ready(function() {

            $('#entity_delete').on("click", function() {
                $('#entity_delete_form').submit()
            });

            const maxSize = 2000000; // 2 MB

            const sections = [];

            for (let i = 1; i < 21; i++) {
                sections.push({
                    input: `#image_${i}`,
                    img: `#img_${i}`,
                    span: `#image_span_${i}`,
                    remove: `#remove_image_${i}`,
                    section: `#upload_area_${i}`,
                    delete: `#image_remove_${i}`
                });
            }

            function handleFileInput(file, index) {
                if (!file) return;
                const section = sections[index];

                if (file.size > maxSize) {
                    $(section.span).html('Максимальный размер 2 МБ').css({
                        color: "rgb(239 68 68)"
                    });
                    return;
                }

                $(section.span).html(file.name).css({
                    color: "rgb(71 85 105)"
                });
                $(section.section).find('.flex.items-center').hide();
                $(section.remove).show();
                $(section.delete).val('');
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
                    $(section.span).html('Максимальный размер 2 МБ').css({
                        color: "rgb(239 68 68)"
                    });
                    return;
                }
                $(section.span).html(file.name).css({
                    color: "rgb(71 85 105)"
                });
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
                $(section.span).html('Выберите файл').css({
                    color: "rgb(71 85 105)"
                });
                $(section.remove).hide();
                $(section.delete).val('delete');
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
    @vite(['resources/js/mask_phone.js'])
</div>
