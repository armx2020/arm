<div class="pt-6 px-4 max-w-7xl mx-auto mb-4 flex flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden">
                <div class="relative w-full h-full md:h-auto">
                    <div class="bg-white rounded-lg relative">
                        <div class="flex items-start p-5 border-b rounded-t">
                            <div class="flex items-center mb-4">
                                <img class="h-10 w-10 rounded-lg m-4" src="{{ url('/image/no-image.png') }}"
                                    alt="image">
                                <h3 class="text-2xl font-bold leading-none text-gray-900">Новая сущность</h3>
                            </div>
                        </div>

                        <div class="p-6 space-y-6">
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.entity.store') }}">
                                @csrf
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name"
                                            class="text-sm font-medium text-gray-900 block mb-2">Название *</label>
                                        <input type="text" name="name" id="name"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                            required :value="old('name')">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="address"
                                            class="text-sm font-medium text-gray-900 block mb-2">Адрес</label>
                                        <input type="text" name="address" id="address"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                            :value="old('address')">
                                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="description"
                                            class="text-sm font-medium text-gray-900 block mb-2">Описание</label>
                                        <input type="text" name="description" id="description"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                            :value="old('description')">
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="phone"
                                            class="text-sm font-medium text-gray-900 block mb-2">Телефон</label>
                                        <input type="tel" name="phone" id="phone"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                            :value="old('phone')">
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>

                                    {{-- Тип сущности --}}
                                    <div class="col-span-6">
                                        <label for="selectedType"
                                            class="text-sm font-medium text-gray-900 block mb-2">Тип
                                            сущности</label>
                                        <select name="type" id="selectedType" wire:model="selectedType" required
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                            <option selected value=""> -- не выбрано --</option>
                                            @foreach ($typies as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @isset($categories)
                                        @if ($this->selectedType == 1)
                                            <div class="col-span-6">
                                                <label for="fields"
                                                    class="text-sm font-medium text-gray-900 block mb-2">Направление</label>
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
                                        @else
                                            <div class="col-span-6">
                                                <label for="category"
                                                    class="text-sm font-medium text-gray-900 block mb-2">Категория</label>
                                                <select name="category" id="category" required
                                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                                    <option selected value=""> -- не выбрано --</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    @endisset



                                    <div class="col-span-6">
                                        <label for="user"
                                            class="text-sm font-medium text-gray-900 block mb-2">Пользователь</label>
                                        <select name="user" id="user"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                            <option selected value=""> -- без пользователя --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->firstname }}
                                                    {{ $user->lastname }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="select_city"
                                            class="text-sm font-medium text-gray-900 block mb-2">Город
                                            *</label>
                                        <select name="city"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                                            <option value='1'> -- выбор города -- </option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr class="my-5">
                                <div class="flex flex-row">
                                    <div id="dropzone"
                                        class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5 border-2 border-dashed border-gray-300 flex justify-center items-center cursor-pointer">
                                        <p class="text-gray-500 text-sm text-center">Перетащите изображение сюда или
                                            нажмите, чтобы выбрать файл</p>
                                        <input type="file" name="image" id="image" class="hidden"
                                            accept="image/*">
                                    </div>
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                                <hr class="my-3">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <label for="web"
                                            class="text-sm font-medium text-gray-900 block mb-2">Web</label>
                                        <input type="text" name="web" id="web"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                            :value="old('web')">
                                        <x-input-error :messages="$errors->get('web')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="whatsapp"
                                            class="text-sm font-medium text-gray-900 block mb-2">Whatsapp</label>
                                        <input type="text" name="whatsapp" id="whatsapp"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                            :value="old('whatsapp')">
                                        <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="telegram"
                                            class="text-sm font-medium text-gray-900 block mb-2">Telegram</label>
                                        <input type="text" name="telegram" id="telegram"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                            :value="old('telegram')">
                                        <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="instagram"
                                            class="text-sm font-medium text-gray-900 block mb-2">Instagram</label>
                                        <input type="text" name="instagram" id="instagram"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                            :value="old('instagram')">
                                        <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="vkontakte"
                                            class="text-sm font-medium text-gray-900 block mb-2">Vkontakte</label>
                                        <input type="text" name="vkontakte" id="vkontakte"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                            :value="old('vkontakte')">
                                        <x-input-error :messages="$errors->get('vkontakte')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="items-center py-6 border-gray-200 rounded-b">
                                    <button
                                        class="text-white w-full bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        type="submit">Добавить</button>
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
        });
    </script>

</div>
