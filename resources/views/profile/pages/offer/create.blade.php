@extends('layouts.app')

@section('title')
    <title>Все армяне - Мои товары и услуги</title>
@endsection

@section('meta')
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Все армяне - создать товар или услугу">
@endsection

@section('scripts')
    <script src="{{ url('/select2.min.js') }}"></script>
    <script src="{{ url('/jquery.maskedinput.min.js') }}"></script>
    @vite(['resources/css/select.css'])
    @livewireStyles
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row mx-auto my-10">

        @include('profile.menu')

        <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
            <div class="flex flex-col basis-full">
                <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-2 lg:p-10 relative">
                    <form method="post" action="{{ route('myoffers.store') }}" class="w-full" enctype="multipart/form-data">
                        @csrf

                        <div class="w-full">
                            <h2 class="text-xl">Добавить товар или услугу</h2>
                            <hr class="w-full h-2 mt-2">
                        </div>

                        <div class="border-b min-h-auto overflow-hidden pb-2" wire:ignore>
                            <div id="sortable-slots"></div>
                            <div id="add-slot-container"></div>
                        </div>

                        <div>
                            <x-input-error :messages="$errors->get('image')" />
                        </div>

                        <div class="my-3">
                            <x-input-label for="name" :value="__('Название *')" />
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
                            <label for="entity" class="text-sm font-medium text-gray-900 block mb-2">Компания</label>
                            <select name="entity" id="entity"
                                class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5"
                                required>
                                <option value=""> -- Выберите компанию -- </option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" class="text-ellipsis overflow-hidden text-nowrap"
                                        @checked(old('entity') == $company->id)>
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
                            <div class="flex border-2 rounded-lg p-4 mt-1" id="checkbox-group"
                                @if (count($errors->get('category')) > 0) border-1 border-red-300 @endif">
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
                                                        required @if (is_array(old('category')) && in_array($child->id, old('category'))) checked @endif
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
                        url: "{{ route('cities') }}",
                        type: "GET",
                        delay: 250,
                        dataType: 'json',
                        data: function (params) {
                            return {
                                query: params.term || '',
                                page: params.page || 1,
                                "_token": "{{ csrf_token() }}"
                            };
                        },
                        processResults: function (response, params) {
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

            const maxSlots = 20;
            // Макс размер файла — 2MB
            const maxSize  = 2 * 1024 * 1024;

            const $sortable = $('#sortable-slots');
            const $addSlotContainer = $('#add-slot-container');

            $sortable.sortable({
                items: '.image-slot',
                cancel: 'input, button, label',
            });

            createEmptySlot();

            /**
             * Создание пустого слота (поле добавки) в #add-slot-container.
             */
            function createEmptySlot() {
                const slotCount = $sortable.find('.image-slot').length;
                if (slotCount >= maxSlots) {
                    return;
                }

                $addSlotContainer.empty();

                const $slot = cloneSlotTemplate();

                initSlot($slot, /* isEmptySlot */ true);

                $addSlotContainer.append($slot);
            }

            /**
             * Создание "обычного" слота (после выбора файла) в #sortable-slots.
             */
            function createFilledSlot(file) {
                const $slot = cloneSlotTemplate();
                initSlot($slot, false);

                const fileInput = $slot.find('.file-input')[0];
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                const reader = new FileReader();
                reader.onload = (e) => {
                    $slot.find('.preview-img').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);

                $slot.find('.file-label').addClass('hidden');

                $slot.find('.remove-image-btn').show();

                $sortable.append($slot);
            }

            function initSlot($slot, isEmptySlot) {
                const $fileInput = $slot.find('.file-input');
                const $removeBtn = $slot.find('.remove-image-btn');
                const $img       = $slot.find('.preview-img');
                const $labelSpan = $slot.find('.file-label span');

                if (isEmptySlot) {
                    $removeBtn.hide();
                }

                $fileInput.on('change', function(){
                    const file = this.files[0];
                    if (!file) {
                        return;
                    }
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
                        reader.onload = function(e){
                            $img.attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                        $labelSpan.text(file.name);

                        $removeBtn.show();
                    }
                });

                $removeBtn.on('click', function(){
                    $slot.remove();

                    const slotCount = $sortable.find('.image-slot').length;
                    if (slotCount < maxSlots) {
                        if ($addSlotContainer.find('.image-slot').length === 0) {
                            createEmptySlot();
                        }
                    }
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
            }

            function cloneSlotTemplate() {
                const template = document.getElementById('image-slot-template');
                return $(template.content.cloneNode(true)).find('.image-slot');
            }

        });
    </script>
@endsection

@section('body')
    @vite(['resources/js/mask_phone.js'])
    @livewireScripts
@endsection
