@extends('layouts.app')

@section('title')
    <title>Все армяне - Мои компании</title>
@endsection

@section('meta')
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Все армяне - изменить компанию">
@endsection

@section('scripts')
    <script src="{{ url('/select2.min.js') }}"></script>
    <script src="{{ url('/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ url('/jquery-ui.min.js') }}"></script>
    @vite(['resources/css/select.css'])
    @livewireStyles
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row mx-auto my-10">

        @include('profile.menu')

        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
            <div class="flex flex-col basis-full">
                <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-5 relative">
                    <form id="card-form" method="post" action="{{ route('mycompanies.update', ['mycompany' => $entity->id]) }}"
                        class="w-full" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="w-full">
                            <h2 class="text-xl">Редактировать компанию</h2>
                            <hr class="w-full h-2 my-2">
                        </div>

                        @php
                            $images = $entity->images()->get();
                        @endphp

                        <div class="border-b min-h-auto overflow-hidden pb-2" wire:ignore>
                            <div id="sortable-slots"></div>
                            <div id="add-slot-container"></div>
                        </div>

                        <div>
                            <x-input-error :messages="$errors->get('image')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="name" :value="__('Название*')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $entity->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="address" :value="__('Адрес')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $entity->address)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="description" :value="__('Описание')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                :value="old('description', $entity->description)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="checkbox-group" :value="__('Выберите деятельность *')" />
                            <div class="flex border-2 rounded-lg p-4 mt-1">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full">

                                    @foreach ($categories as $item)
                                        <div class="flex flex-col gap-1">
                                            <div class="flex">
                                                @if (count($item->categories) < 1)
                                                    <input type="checkbox" name="fields[]" value="{{ $item->id }}"
                                                        @checked($entity->fields->contains($item->id))
                                                        @if (is_array(old('fields')) && in_array($item->id, old('fields'))) checked @endif
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
                                                <div class="flex pl-4">
                                                    <input type="checkbox" name="fields[]" value="{{ $child->id }}"
                                                        @checked($entity->fields->contains($child->id))
                                                        class="checkbox-{{ $loop->parent->iteration }} shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                        id="checkbox-{{ $child->id }}">
                                                    <label for="checkbox-{{ $child->id }}"
                                                        class="text-sm text-gray-400 ms-3 dark:text-neutral-400">{{ $child->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('fields')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="phone" :value="__('Телефон')" />
                            <x-text-input id="phone" name="phone" type="text"
                                class="mt-1 block w-full mask-phone" placeholder='+7 (***) ***-**-**' :value="old('phone', $entity->phone)"
                                autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="whatsapp" :value="__('Whatsapp')" />
                            <x-text-input id="whatsapp" name="whatsapp" type="text" class="mt-1 block w-full"
                                placeholder='https://wa.me/***********' :value="old('whatsapp', $entity->whatsapp)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="web" :value="__('Веб')" />
                            <x-text-input id="web" name="web" type="text" class="mt-1 block w-full"
                                placeholder='https://***********.**' :value="old('web', $entity->web)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('web')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="telegram" :value="__('Телеграм')" />
                            <x-text-input id="telegram" name="telegram" type="text" class="mt-1 block w-full"
                                placeholder='https://t.me/******' :value="old('telegram', $entity->telegram)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('telegram')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="vkontakte" :value="__('Вконтакте')" />
                            <x-text-input id="vkontakte" name="vkontakte" type="text" class="mt-1 block w-full"
                                placeholder='https://vk.com/***********' :value="old('vkontakte', $entity->vkontakte)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('vkontakte')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="instagram" :value="__('Инстаграм')" />
                            <x-text-input id="instagram" name="instagram" type="text" class="mt-1 block w-full"
                                placeholder='https://www.instagram.com/*******' :value="old('instagram', $entity->instagram)" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                        </div>

                        <div class="my-3">
                            <label for="city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
                            <select name="city" class="w-full" style="border-color: rgb(209 213 219)" id="city">
                                <option value='{{ $entity->city->id }}'>{{ $entity->city->name }}</option>
                            </select>
                        </div>

                        <div class="my-5">
                            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                        </div>
                    </form>
                </div>

                <div class="flex basis-full bg-gray-200 rounded-md p-3 my-6 text-sm">
                    <form method="post" action="{{ route('mycompanies.destroy', ['mycompany' => $entity->id]) }}"
                        class="w-full text-center">
                        @csrf
                        @method('delete')

                        <div class="m-2 flex flex-row justify-between basis-full">
                            <div class="text-base font-medium text-gray-900 flex items-center">
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

            const maxSlots         = 20;
            const maxSize          = 2 * 1024 * 1024; // 2MB
            let newImageCounter    = 1;

            const $sortable        = $('#sortable-slots');
            const $addSlotContainer= $('#add-slot-container');
            const $form            = $('#card-form');

            let existingImages = @json($images);

            existingImages = existingImages.sort((a,b) => (a.sort_id || 0) - (b.sort_id || 0));

            existingImages.forEach(img => {
                createExistingSlot(img);
            });

            createEmptySlot();

            $sortable.sortable({
                items: '.image-slot',
                cancel: 'input, button, label'
            });

            function createExistingSlot(image) {
                const $slot = cloneSlotTemplate();

                $slot.attr('data-id', image.id);

                $slot.find('.preview-img').attr('src', '/storage/' + image.path);

                $slot.find('.file-label').addClass('hidden');

                $slot.find('.remove-image-btn').show().on('click', function() {
                    $slot.remove();
                    maybeCreateEmptySlot();
                });

                initDragAndDrop($slot);
                $sortable.append($slot);
            }

            function createEmptySlot() {
                const slotCount = $sortable.find('.image-slot').length;
                if (slotCount >= maxSlots) {
                    return;
                }

                $addSlotContainer.empty();

                const $slot = cloneSlotTemplate();
                initSlotForNew($slot, true);

                $addSlotContainer.append($slot);
            }

            function createFilledSlot(file) {
                const $slot = cloneSlotTemplate();
                const newId = 'new_' + (newImageCounter++);
                $slot.attr('data-id', newId);

                initSlotForNew($slot, false);

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
                const $preview   = $slot.find('.preview-img');

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
                        reader.onload = (e) => {
                            $preview.attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                $removeBtn.on('click', function() {
                    $slot.remove();
                    maybeCreateEmptySlot();
                });

                initDragAndDrop($slot);
            }

            function maybeCreateEmptySlot() {
                const slotCount = $sortable.find('.image-slot').length;
                if (slotCount < maxSlots) {
                    if ($addSlotContainer.find('.image-slot').length === 0) {
                        createEmptySlot();
                    }
                }
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

                    const $idHidden = $(`<input type="hidden" name="images[${index}][id]" value="${slotId}">`);
                    $form.append($idHidden);

                    const $sortIdHidden = $(`<input type="hidden" name="images[${index}][sort_id]" value="${sortId}">`);
                    $form.append($sortIdHidden);

                    const $fileInput = $slot.find('.file-input');
                    if ($fileInput.length) {
                        $fileInput.attr('name', `images[${index}][file]`);
                    }
                });
            });

        });
    </script>
@endsection

@section('body')
    @vite(['resources/js/mask_phone.js'])
    @livewireScripts
@endsection
