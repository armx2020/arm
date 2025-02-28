<div>
    <div class="pt-6 px-4 xl:pl-10 xl:pr-0 max-w-7xl mx-auto mb-4 flex flex-col">
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

                            <form id="card-form" method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.entity.update', ['entity' => $entity->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="flex justify-between p-5 border-b rounded-t">
                                    <div class="flex items-center">
                                        <h3 class="text-2xl font-bold leading-none text-gray-900">
                                            {{ $entity->name }}</h3>
                                    </div>
                                    <div class="flex items-center pl-7">
                                        @if(isset($duplicateExists) && $duplicateExists == true)
                                            <a href="{{ route('admin.entity.index', ['double_id' => $entity->id]) }}" class="mr-5 text-white bg-orange-700 font-medium rounded-lg text-sm px-2 px-3 py-2 text-center">
                                                Дубль
                                            </a>
                                        @endif
                                        @if ($entity->region_top == 1 || $entity->region_top == 2 || $entity->region_top == 3)
                                            <div
                                                class="mr-5 text-white bg-sky-600 font-medium rounded-lg text-sm px-2 px-3 py-2 text-center">
                                                Топ регион {{ $entity->region_top }}
                                            </div>
                                        @endif
                                        @if ($entity->city_top == 1 || $entity->city_top == 2 || $entity->city_top == 3)
                                            <div
                                                class="mr-5 text-white bg-sky-600 font-medium rounded-lg text-sm px-2 px-3 py-2 text-center">
                                                Топ город {{ $entity->city_top }}
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


                                @php
                                    $images = $entity->images()->withoutGlobalScopes()->get();
                                @endphp

                                <div class="border-b min-h-auto overflow-hidden pb-2" wire:ignore>
                                    <div id="sortable-slots"></div>
                                    <div id="add-slot-container"></div>
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
                                                                                class="checkbox-{{ $loop->iteration }} shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                                                id="checkbox-{{ $item->id }}">
                                                                            <label for="checkbox-{{ $item->id }}"
                                                                                class="text-sm text-gray-500 ms-3">{{ $item->name }}</label>
                                                                        @else
                                                                            <label
                                                                                for="checkbox-group-{{ $loop->iteration }}"
                                                                                class="text-base text-black ms-3">{{ $item->name }}</label>
                                                                        @endif
                                                                    </div>
                                                                    @foreach ($item->categories as $child)
                                                                        <div class="flex">
                                                                            <input type="checkbox" name="fields[]"
                                                                                value="{{ $child->id }}"
                                                                                @checked($entity->fields->contains($child->id))
                                                                                @if (is_array(old('fields')) && in_array($child->id, old('fields'))) checked @endif
                                                                                class="checkbox-{{ $loop->parent->iteration }} shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                                                id="checkbox-{{ $child->id }}">
                                                                            <label for="checkbox-{{ $child->id }}"
                                                                                class="text-sm text-gray-500 ms-3">{{ $child->name }}</label>
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
                                            <textarea type="text" name="description" id="description" rows="10"
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
                                            <x-input-label for="paymant_link" :value="__('Платёжная ссылка')" />
                                            <x-text-input id="paymant_link" name="paymant_link" type="text"
                                                class="mt-1 block w-full bg-gray-50"
                                                placeholder='https://***********.**' :value="old('paymant_link', $entity->paymant_link)" />
                                            <x-input-error class="mt-2" :messages="$errors->get('paymant_link')" />
                                        </div>

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

    <template id="image-slot-template">
        <div class="image-slot border border-dashed border-gray-300 relative p-2 float-left
                flex items-center space-x-2 rounded-md ml-2 my-1" data-id="">

            <img class="preview-img w-20 h-20 object-cover rounded-md" src="{{ url('/image/no-image.png') }}">

            <button type="button" class="remove-image-btn absolute top-3 right-3" style="display: none;">
                <img src="{{ url('/image/remove.png') }}" class="w-5 h-5">
            </button>

            <label class="file-label cursor-pointer flex-grow text-center">
                <input type="file" class="file-input hidden" accept=".jpg,.jpeg,.png">
                <span class="text-sm text-gray-500">
                    <div class="text-left px-2">Выберите файл или</div>
                    <div class="text-left px-2">перетащите сюда</div>
                </span>
            </label>
        </div>
    </template>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#entity_delete').on("click", function() {
                $('#entity_delete_form').submit();
            });

            const maxSlots = 20;
            const maxSize  = 20 * 1024 * 1024; // 2MB
            let newImageCounter = 1;

            const $sortable = $('#sortable-slots');
            const $addSlotContainer = $('#add-slot-container');
            const $form = $('#card-form');

            let existingImages = @json($images);
            existingImages = existingImages.sort((a, b) => (a.sort_id || 0) - (b.sort_id || 0));
            existingImages.forEach(img => {
                createExistingSlot(img);
            });
            createEmptySlot();

            $sortable.sortable({
                items: '.image-slot',
                cancel: 'input, button, label'
            });

            $addSlotContainer.on('click', function(e) {
                if (e.target === this) {
                    let $emptySlot = $(this).find('.image-slot').first();
                    if ($emptySlot.length === 0) {
                        createEmptySlot();
                        $emptySlot = $(this).find('.image-slot').first();
                    }
                    $emptySlot.find('.file-input').trigger('click');
                }
            });

            $(document).on('paste', function(e) {
                let totalCount = $sortable.find('.image-slot').length;
                if (totalCount >= maxSlots) {
                    $addSlotContainer.hide();
                    return;
                }
                const clipboardItems = (e.originalEvent.clipboardData || e.clipboardData).items;
                if (clipboardItems) {
                    for (let i = 0; i < clipboardItems.length; i++) {
                        if (clipboardItems[i].type.indexOf("image") !== -1) {
                            const file = clipboardItems[i].getAsFile();
                            if (file) {
                                if (file.size > maxSize) {
                                    alert('Файл больше 2МБ!');
                                    return;
                                }
                                totalCount = $sortable.find('.image-slot').length;
                                if (totalCount >= maxSlots) {
                                    $addSlotContainer.hide();
                                    return;
                                }
                                createFilledSlot(file);
                                maybeCreateEmptySlot();
                            }
                        }
                    }
                }
            });

            function createExistingSlot(image) {
                const $slot = cloneSlotTemplate();
                $slot.attr('data-id', image.id);
                $slot.find('.preview-img').attr('src', '/storage/' + image.path);
                $slot.find('.file-label').addClass('hidden');
                $slot.find('.remove-image-btn').show().on('click', function(e) {
                    e.stopPropagation();
                    $slot.remove();
                    maybeCreateEmptySlot();
                });
                initDragAndDrop($slot);
                $sortable.append($slot);
            }

            function createEmptySlot() {
                const slotCount = $sortable.find('.image-slot').length;
                if (slotCount >= maxSlots) return;
                $addSlotContainer.empty().show();
                const $slot = cloneSlotTemplate();
                initSlotForNew($slot, true);
                $addSlotContainer.append($slot);
            }

            function createFilledSlot(file) {
                const $slot = cloneSlotTemplate();
                initSlotForNew($slot, false);
                const newId = 'new_' + (newImageCounter++);
                $slot.attr('data-id', newId);
                const fileInput = $slot.find('.file-input')[0];
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                const reader = new FileReader();
                reader.onload = function(e) {
                    $slot.find('.preview-img').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
                $slot.find('.file-label').addClass('hidden');
                $slot.find('.remove-image-btn').show();
                $sortable.append($slot);
            }

            function initSlotForNew($slot, isEmptySlot) {
                const $fileInput = $slot.find('.file-input');
                const $removeBtn = $slot.find('.remove-image-btn');
                const $preview = $slot.find('.preview-img');

                $slot.data('isEmpty', isEmptySlot);

                $fileInput.on('click', function(e) {
                    e.stopPropagation();
                });

                if (isEmptySlot) {
                    $removeBtn.hide();
                }

                $fileInput.on('change', function() {
                    const file = this.files[0];
                    if (!file) return;
                    if (file.size > maxSize) {
                        alert('Файл больше 2МБ!');
                        $fileInput.val('');
                        return;
                    }
                    if (isEmptySlot) {
                        createFilledSlot(file);
                        createEmptySlot();
                        $slot.remove();
                    } else {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $preview.attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                $removeBtn.on('click', function(e) {
                    e.stopPropagation();
                    $slot.remove();
                    maybeCreateEmptySlot();
                });

                $slot.on('dragover', function(e) {
                    e.preventDefault();
                    $slot.css('background-color', '#f1f5f9');
                });
                $slot.on('dragleave', function(e) {
                    e.preventDefault();
                    $slot.css('background-color', '');
                });
                $slot.on('drop', function(e) {
                    e.preventDefault();
                    $slot.css('background-color', '');
                    const files = e.originalEvent.dataTransfer.files;
                    if (files && files.length > 0) {
                        $fileInput[0].files = files;
                        $fileInput.trigger('change');
                    }
                });

                $slot.on('click', function(e) {
                    if ($slot.data('isEmpty') && !$(e.target).closest('.remove-image-btn, .file-input, label').length) {
                        $fileInput.trigger('click');
                    }
                });
            }

            function initDragAndDrop($slot) {
                $slot.on('dragover', function(e) {
                    e.preventDefault();
                    $slot.css('background-color', '#f1f5f9');
                });
                $slot.on('dragleave', function(e) {
                    e.preventDefault();
                    $slot.css('background-color', '');
                });
                $slot.on('drop', function(e) {
                    e.preventDefault();
                    $slot.css('background-color', '');
                    const files = e.originalEvent.dataTransfer.files;
                    if (files && files.length > 0) {
                        $slot.find('.file-input')[0].files = files;
                        $slot.find('.file-input').trigger('change');
                    }
                });
            }

            function cloneSlotTemplate() {
                const template = document.getElementById('image-slot-template');
                return $(template.content.cloneNode(true)).find('.image-slot');
            }

            $form.on('submit', function(e) {
                $form.find('input[type="hidden"][name^="images["]').remove();
                const $slots = $sortable.find('.image-slot');
                $slots.each(function(index) {
                    const $slot = $(this);
                    const slotId = $slot.attr('data-id');
                    const sortId = index;
                    $form.append(`<input type="hidden" name="images[${index}][id]" value="${slotId}">`);
                    $form.append(`<input type="hidden" name="images[${index}][sort_id]" value="${sortId}">`);
                    const $fileInput = $slot.find('.file-input');
                    if ($fileInput.length) {
                        $fileInput.attr('name', `images[${index}][file]`);
                    }
                });
            });
        });
    </script>
    @vite(['resources/js/mask_phone.js'])
    <script src="{{ url('/jquery-ui.min.js') }}"></script>
</div>
